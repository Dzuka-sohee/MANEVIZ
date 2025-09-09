@extends('layouts.app2')

@section('content')
<style>
    .success-container {
        background-color: #f8f9fa;
        min-height: 100vh;
        padding: 100px 20px 50px;
    }

    .success-card {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        text-align: center;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: #28a745;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
    }

    .success-icon svg {
        width: 40px;
        height: 40px;
        color: white;
    }

    .success-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
    }

    .success-message {
        font-size: 1.2rem;
        color: #6c757d;
        margin-bottom: 30px;
    }

    .order-details {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 25px;
        margin: 30px 0;
        text-align: left;
    }

    .order-number {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        padding: 5px 0;
    }

    .detail-label {
        color: #6c757d;
        font-weight: 500;
    }

    .detail-value {
        color: #333;
        font-weight: 600;
    }

    .order-items {
        margin-top: 25px;
    }

    .items-title {
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e9ecef;
    }

    .order-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .item-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-info {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .item-details {
        font-size: 14px;
        color: #6c757d;
    }

    .item-price {
        font-weight: 600;
        color: #333;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: #333;
        color: white;
    }

    .btn-primary:hover {
        background: #555;
        color: white;
        text-decoration: none;
    }

    .btn-secondary {
        background: white;
        color: #333;
        border: 2px solid #333;
    }

    .btn-secondary:hover {
        background: #333;
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .success-card {
            padding: 25px;
        }

        .success-title {
            font-size: 2rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .detail-row {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>

<div class="success-container">
    <div class="success-card">
        <div class="success-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h1 class="success-title">Order Placed Successfully!</h1>
        <p class="success-message">Thank you for your purchase. Your order has been received and is being processed.</p>
        
        <div class="order-details">
            <div class="order-number">Order #{{ $order->order_number }}</div>
            
            <div class="detail-row">
                <span class="detail-label">Order Date:</span>
                <span class="detail-value">{{ $order->created_at->format('d M Y, H:i') }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Payment Method:</span>
                <span class="detail-value">{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Shipping Address:</span>
                <span class="detail-value">
                    {{ $order->shipping_name }}<br>
                    {{ $order->shipping_address }}<br>
                    {{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}
                </span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Total Amount:</span>
                <span class="detail-value">{{ $order->formatted_total }}</span>
            </div>

            <div class="order-items">
                <div class="items-title">Ordered Items</div>
                
                @foreach($order->items as $item)
                    <div class="order-item">
                        <div class="item-image">
                            @if($item->product && $item->product->images && $item->product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product_name }}">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                            @endif
                        </div>
                        <div class="item-info">
                            <div class="item-name">{{ $item->product_name }}</div>
                            <div class="item-details">
                                Qty: {{ $item->quantity }}
                                @if($item->color) | Color: {{ $item->color }} @endif
                                @if($item->size) | Size: {{ $item->size }} @endif
                            </div>
                        </div>
                        <div class="item-price">{{ $item->formatted_total }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Continue Shopping</a>
            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">View Order Details</a>
        </div>
    </div>
</div>
@endsection