<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class MidtransService
{
    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('midtrans.is_production', false);
        // Set sanitization on (default)
        Config::$isSanitized = config('midtrans.is_sanitized', true);
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('midtrans.is_3ds', true);
    }

    public function createSnapTokenFromData($orderData)
    {
        // Prepare transaction details
        $transactionDetails = [
            'order_id' => $orderData['order_number'],
            'gross_amount' => (int) $orderData['total'], // Convert to integer
        ];

        // Prepare item details
        $itemDetails = [];
        foreach ($orderData['items'] as $item) {
            $price = $item->product->harga_jual ?? $item->product->harga;
            $itemDetails[] = [
                'id' => $item->product_id,
                'price' => (int) $price,
                'quantity' => $item->kuantitas,
                'name' => $item->product->name,
            ];
        }

        // Add tax and shipping as separate items
        if ($orderData['tax'] > 0) {
            $itemDetails[] = [
                'id' => 'TAX',
                'price' => (int) $orderData['tax'],
                'quantity' => 1,
                'name' => 'Tax (2.5%)',
            ];
        }

        $itemDetails[] = [
            'id' => 'SHIPPING',
            'price' => (int) $orderData['shipping_cost'],
            'quantity' => 1,
            'name' => 'Shipping Cost',
        ];

        // Prepare customer details
        $customerDetails = [
            'first_name' => $orderData['customer']['name'],
            'email' => $orderData['customer']['email'],
            'phone' => $orderData['customer']['phone'],
            'billing_address' => [
                'first_name' => $orderData['billing']['name'],
                'email' => $orderData['billing']['email'],
                'phone' => $orderData['billing']['phone'],
                'address' => $orderData['billing']['address'],
                'city' => $orderData['billing']['city'],
                'postal_code' => $orderData['billing']['postal_code'],
                'country_code' => 'IDN'
            ],
            'shipping_address' => [
                'first_name' => $orderData['shipping']['name'],
                'email' => $orderData['shipping']['email'],
                'phone' => $orderData['shipping']['phone'],
                'address' => $orderData['shipping']['address'],
                'city' => $orderData['shipping']['city'],
                'postal_code' => $orderData['shipping']['postal_code'],
                'country_code' => 'IDN'
            ]
        ];

        // Prepare transaction data
        $transactionData = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        // Optional: Add credit card specific config
        $transactionData['credit_card'] = [
            'secure' => true
        ];

        // Optional: Add expiry time (24 hours from now)
        $transactionData['expiry'] = [
            'start_time' => date('Y-m-d H:i:s O'),
            'unit' => 'hours',
            'duration' => 24
        ];

        try {
            $snapToken = Snap::getSnapToken($transactionData);
            return $snapToken;
        } catch (\Exception $e) {
            throw new \Exception('Failed to create payment token: ' . $e->getMessage());
        }
    }

    public function getTransactionStatus($orderId)
    {
        try {
            $status = Transaction::status($orderId);
            return $status;
        } catch (\Exception $e) {
            throw new \Exception('Failed to get transaction status: ' . $e->getMessage());
        }
    }

    // Legacy method for backward compatibility
    public function createSnapToken($order)
    {
        // Convert order model to data array
        $orderData = [
            'order_number' => $order->order_number,
            'total' => $order->grand_total,
            'subtotal' => $order->subtotal ?? $order->total_amount,
            'tax' => $order->tax ?? 0,
            'shipping_cost' => $order->shipping_cost,
            'customer' => [
                'name' => $order->shipping_name,
                'email' => $order->shipping_email,
                'phone' => $order->shipping_phone,
            ],
            'shipping' => [
                'name' => $order->shipping_name,
                'email' => $order->shipping_email,
                'phone' => $order->shipping_phone,
                'address' => $order->shipping_address,
                'city' => $order->shipping_city,
                'postal_code' => $order->shipping_postal_code,
            ],
            'billing' => [
                'name' => $order->billing_name ?? $order->shipping_name,
                'email' => $order->billing_email ?? $order->shipping_email,
                'phone' => $order->billing_phone ?? $order->shipping_phone,
                'address' => $order->billing_address ?? $order->shipping_address,
                'city' => $order->billing_city ?? $order->shipping_city,
                'postal_code' => $order->billing_postal_code ?? $order->shipping_postal_code,
            ],
            'items' => $order->orderItems ?? $order->items,
        ];

        return $this->createSnapTokenFromData($orderData);
    }
}