@extends('layouts.app2')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.6;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .payment-header {
        text-align: center;
        margin: 100px 0 40px;
    }

    .payment-title {
        font-size: 2.5rem;
        font-weight: bold;
        text-transform: uppercase;
        color: #333;
        margin-bottom: 10px;
    }

    .payment-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
    }

    .payment-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }

    .order-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f8f9fa;
    }

    .info-group h4 {
        color: #333;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .info-group p {
        color: #6c757d;
        font-size: 14px;
        margin: 5px 0;
    }

    .payment-section {
        text-align: center;
        padding: 40px 20px;
    }

    .payment-button {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border: none;
        padding: 16px 40px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,123,255,0.3);
        margin: 20px 10px;
    }

    .payment-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,123,255,0.4);
    }

    .back-button {
        background: #6c757d;
        color: white;
        border: none;
        padding: 12px 30px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-right: 10px;
    }

    .back-button:hover {
        background: #5a6268;
        transform: translateY(-1px);
        text-decoration: none;
        color: white;
    }

    .order-summary {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        margin: 20px 0;
    }

    .summary-title {
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .summary-row.total {
        font-weight: bold;
        font-size: 18px;
        padding-top: 15px;
        border-top: 2px solid #dee2e6;
        margin-top: 15px;
        color: #333;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .loading {
        display: none;
        text-align: center;
        padding: 20px;
    }

    .spinner {
        display: inline-block;
        width: 32px;
        height: 32px;
        border: 3px solid rgba(0,0,0,.1);
        border-radius: 50%;
        border-top-color: #007bff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .order-items {
        margin: 20px 0;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-name {
        font-weight: 600;
        color: #333;
    }

    .item-details {
        font-size: 14px;
        color: #6c757d;
    }

    .item-price {
        font-weight: bold;
        color: #333;
    }

    .payment-methods-info {
        text-align: center;
        margin: 30px 0;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .payment-methods-info h5 {
        color: #333;
        margin-bottom: 15px;
    }

    .payment-methods-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }

    .payment-method-item {
        text-align: center;
        padding: 10px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .payment-method-item img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        margin-bottom: 5px;
    }

    .payment-method-item span {
        font-size: 12px;
        color: #6c757d;
    }

    @media (max-width: 768px) {
        .order-info {
            grid-template-columns: 1fr;
        }
        
        .payment-title {
            font-size: 2rem;
        }
        
        .container {
            padding: 15px;
        }
        
        .payment-card {
            padding: 20px;
        }
    }
</style>

<div class="container">
    <div class="payment-header">
        <h1 class="payment-title">Payment</h1>
        <p class="payment-subtitle">Complete your payment for Order #{{ $order->order_number }}</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="payment-card">
        <!-- Order Information -->
        <div class="order-info">
            <div class="info-group">
                <h4>Order Details</h4>
                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                <p><strong>Order Date:</strong> {{ $order->order_date->format('d M Y H:i') }}</p>
                <p><strong>Payment Method:</strong> {{ $order->getPaymentMethodLabelAttribute() }}</p>
                <p><strong>Status:</strong> {{ $order->getStatusLabelAttribute() }}</p>
            </div>
            <div class="info-group">
                <h4>Shipping Information</h4>
                <p><strong>Name:</strong> {{ $order->shipping_name }}</p>
                <p><strong>Email:</strong> {{ $order->shipping_email }}</p>
                <p><strong>Phone:</strong> {{ $order->shipping_phone }}</p>
                <p><strong>Address:</strong> {{ $order->shipping_address }}, {{ $order->shipping_city }}</p>
            </div>
        </div>

        <!-- Order Items -->
        <div class="order-items">
            <h4>Order Items</h4>
            @foreach($order->orderItems as $item)
            <div class="order-item">
                <div>
                    <div class="item-name">{{ $item->product_name }}</div>
                    <div class="item-details">
                        Qty: {{ $item->kuantitas }}
                        @if($item->size) | Size: {{ $item->size }} @endif
                        | IDR {{ number_format($item->product_price, 0, ',', '.') }} each
                    </div>
                </div>
                <div class="item-price">IDR {{ number_format($item->subtotal, 0, ',', '.') }}</div>
            </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h5 class="summary-title">Payment Summary</h5>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>IDR {{ number_format($order->subtotal ?? $order->total_amount, 0, ',', '.') }}</span>
            </div>
            @if(isset($order->tax) && $order->tax > 0)
            <div class="summary-row">
                <span>Tax</span>
                <span>IDR {{ number_format($order->tax, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="summary-row">
                <span>Shipping</span>
                <span>IDR {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row total">
                <span>Total</span>
                <span>IDR {{ number_format($order->grand_total, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Payment Methods Info -->
        <div class="payment-methods-info">
            <h5>Available Payment Methods</h5>
            <p style="font-size: 14px; color: #6c757d; margin-bottom: 15px;">
                Choose from various secure payment options
            </p>
            <div class="payment-methods-grid">
                <div class="payment-method-item">
                    <div style="font-size: 24px;">🏦</div>
                    <span>Bank Transfer</span>
                </div>
                <div class="payment-method-item">
                    <div style="font-size: 24px;">💳</div>
                    <span>Credit Card</span>
                </div>
                <div class="payment-method-item">
                    <div style="font-size: 24px;">📱</div>
                    <span>GoPay</span>
                </div>
                <div class="payment-method-item">
                    <div style="font-size: 24px;">🛒</div>
                    <span>ShopeePay</span>
                </div>
                <div class="payment-method-item">
                    <div style="font-size: 24px;">📊</div>
                    <span>QRIS</span>
                </div>
            </div>
        </div>

        <!-- Payment Section -->
        <div class="payment-section">
            <div class="loading" id="loading">
                <div class="spinner"></div>
                <p>Preparing payment...</p>
            </div>
            
            <div id="payment-buttons">
                <button id="pay-button" class="payment-button">
                    Pay Now - IDR {{ number_format($order->grand_total, 0, ',', '.') }}
                </button>
                <br>
                <a href="{{ route('checkout.success', $order->order_number) }}" class="back-button">
                    Skip Payment (Pay Later)
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Midtrans Snap JS -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script type="text/javascript">
document.getElementById('pay-button').onclick = function(){
    // Show loading
    document.getElementById('loading').style.display = 'block';
    document.getElementById('payment-buttons').style.display = 'none';
    
    // Start payment
    snap.pay('{{ $snapToken }}', {
        // Optional
        onSuccess: function(result) {
            // Hide loading
            document.getElementById('loading').style.display = 'none';
            document.getElementById('payment-buttons').style.display = 'block';
            
            // Show success message
            showNotification('success', 'Payment successful!');
            
            // Check payment status and redirect
            checkPaymentStatus();
        },
        // Optional
        onPending: function(result) {
            // Hide loading
            document.getElementById('loading').style.display = 'none';
            document.getElementById('payment-buttons').style.display = 'block';
            
            showNotification('info', 'Payment pending. Please complete your payment.');
            console.log(result);
        },
        // Optional
        onError: function(result) {
            // Hide loading
            document.getElementById('loading').style.display = 'none';
            document.getElementById('payment-buttons').style.display = 'block';
            
            showNotification('error', 'Payment failed. Please try again.');
            console.log(result);
        }
    });
};

// Function to check payment status
function checkPaymentStatus() {
    fetch(`{{ route('payment.status', $order->order_number) }}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'settlement' || data.status === 'capture') {
                // Payment successful, redirect to success page
                setTimeout(() => {
                    window.location.href = `{{ route('checkout.success', $order->order_number) }}`;
                }, 2000);
            } else if (data.status === 'pending') {
                // Payment still pending
                showNotification('info', 'Payment is being processed...');
                setTimeout(() => {
                    window.location.href = `{{ route('checkout.success', $order->order_number) }}`;
                }, 3000);
            } else {
                // Payment failed or cancelled
                showNotification('error', 'Payment was not completed.');
            }
        })
        .catch(error => {
            console.error('Error checking payment status:', error);
            showNotification('error', 'Error checking payment status.');
        });
}

// Notification function
function showNotification(type, message) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        z-index: 10000;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transform: translateX(400px);
        transition: transform 0.3s ease;
        max-width: 350px;
    `;
    
    // Set background color based on type
    if (type === 'success') {
        notification.style.background = '#28a745';
    } else if (type === 'error') {
        notification.style.background = '#dc3545';
    } else if (type === 'info') {
        notification.style.background = '#17a2b8';
    }
    
    notification.textContent = message;
    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => notification.style.transform = 'translateX(0)', 100);
    
    // Animate out and remove
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 5000);
}