@extends('layouts.app2')

@section('content')
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
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-header {
        margin: 80px 0 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .back-link:hover {
        color: #0056b3;
        text-decoration: none;
    }

    .page-title {
        font-size: 2.2rem;
        font-weight: bold;
        color: #333;
    }

    .order-status-header {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cce5ff; color: #004085; }
    .status-shipped { background: #d4edda; color: #155724; }
    .status-delivered { background: #d1ecf1; color: #0c5460; }
    .status-cancelled { background: #f8d7da; color: #721c24; }
    .payment-paid { background: #d4edda; color: #155724; }
    .payment-pending { background: #fff3cd; color: #856404; }
    .payment-failed { background: #f8d7da; color: #721c24; }

    .order-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .order-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #f0f0f0;
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f8f9fa;
    }

    /* Order Info */
    .order-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }

    .info-section h4 {
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #f5f5f5;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 500;
        color: #666;
    }

    .info-value {
        color: #333;
        font-weight: 600;
    }

    /* Tracking Timeline */
    .tracking-timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 25px;
        position: relative;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 30px;
        width: 2px;
        height: 100%;
        background: #dee2e6;
        z-index: 1;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-dot {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        position: relative;
        z-index: 2;
        font-size: 14px;
        font-weight: bold;
        color: white;
    }

    .timeline-dot.active {
        background: linear-gradient(135deg, #28a745, #20c997);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    .timeline-dot.inactive {
        background: #dee2e6;
        color: #6c757d;
    }

    .timeline-content {
        flex: 1;
        padding-top: 5px;
    }

    .timeline-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .timeline-date {
        font-size: 13px;
        color: #6c757d;
    }

    .timeline-description {
        font-size: 14px;
        color: #666;
        margin-top: 5px;
    }

    /* Order Items */
    .order-items {
        margin-top: 10px;
    }

    .item-row {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        margin-right: 15px;
        background: #f8f9fa;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .item-info {
        font-size: 14px;
        color: #6c757d;
    }

    .item-price {
        text-align: right;
    }

    .item-unit-price {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 3px;
    }

    .item-subtotal {
        font-weight: bold;
        color: #333;
        font-size: 16px;
    }

    /* Order Summary */
    .order-summary {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 12px;
        margin-top: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .summary-row.total {
        font-weight: bold;
        font-size: 20px;
        padding-top: 15px;
        border-top: 2px solid #dee2e6;
        margin-top: 15px;
        color: #333;
    }

    /* Actions */
    .order-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,123,255,0.3);
        color: white;
        text-decoration: none;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
        color: white;
        text-decoration: none;
    }

    .btn-warning {
        background: #ffc107;
        color: #333;
    }

    .btn-warning:hover {
        background: #e0a800;
        color: #333;
        text-decoration: none;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        color: white;
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
        
        .order-card {
            padding: 20px;
        }
        
        .order-info-grid {
            grid-template-columns: 1fr;
        }
        
        .timeline-item {
            margin-bottom: 20px;
        }
        
        .item-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .item-price {
            align-self: flex-end;
            text-align: right;
        }
        
        .order-actions {
            flex-direction: column;
        }
        
        .btn {
            justify-content: center;
        }
    }
</style>

<div class="container">
    <div class="page-header">
        <div>
            <a href="{{ route('orders.index') }}" class="back-link">
                ← Back to Orders
            </a>
            <h1 class="page-title">Order Details</h1>
        </div>
        <div class="order-status-header">
            <span class="status-badge status-{{ $order->status }}">
                {{ $order->getStatusLabelAttribute() }}
            </span>
            <span class="status-badge payment-{{ $order->payment_status }}">
                {{ $order->getPaymentStatusLabelAttribute() }}
            </span>
        </div>
    </div>

    <div class="order-grid">
        <!-- Order Information -->
        <div class="order-card">
            <h2 class="card-title">Order Information</h2>
            <div class="order-info-grid">
                <div class="info-section">
                    <h4>Order Details</h4>
                    <div class="info-item">
                        <span class="info-label">Order Number</span>
                        <span class="info-value">{{ $order->order_number }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Order Date</span>
                        <span class="info-value">{{ $order->order_date->format('d M Y H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Payment Method</span>
                        <span class="info-value">{{ $order->getPaymentMethodLabelAttribute() }}</span>
                    </div>
                    @if($order->transaction_id)
                    <div class="info-item">
                        <span class="info-label">Transaction ID</span>
                        <span class="info-value">{{ $order->transaction_id }}</span>
                    </div>
                    @endif
                </div>

                <div class="info-section">
                    <h4>Shipping Information</h4>
                    <div class="info-item">
                        <span class="info-label">Name</span>
                        <span class="info-value">{{ $order->shipping_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $order->shipping_email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Phone</span>
                        <span class="info-value">{{ $order->shipping_phone }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Address</span>
                        <span class="info-value">{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_province ?? '' }} {{ $order->shipping_postal_code }}</span>
                    </div>
                </div>
            </div>

            @if($order->notes)
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #f0f0f0;">
                <h4>Order Notes</h4>
                <p style="color: #666; margin-top: 10px;">{{ $order->notes }}</p>
            </div>
            @endif
        </div>

        <!-- Order Tracking -->
        <div class="order-card">
            <h2 class="card-title">Order Tracking</h2>
            <div class="tracking-timeline">
                <div class="timeline-item">
                    <div class="timeline-dot active">1</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Order Placed</div>
                        <div class="timeline-date">{{ $order->order_date->format('d M Y H:i') }}</div>
                        <div class="timeline-description">Your order has been successfully placed and confirmed.</div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'active' : 'inactive' }}">2</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Processing</div>
                        @if($order->status === 'processing')
                            <div class="timeline-date">Currently being processed</div>
                            <div class="timeline-description">Your order is being prepared for shipment.</div>
                        @elseif(in_array($order->status, ['shipped', 'delivered']))
                            <div class="timeline-date">Completed</div>
                            <div class="timeline-description">Your order has been processed and prepared.</div>
                        @else
                            <div class="timeline-date">Pending</div>
                            <div class="timeline-description">Waiting for payment confirmation to start processing.</div>
                        @endif
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot {{ in_array($order->status, ['shipped', 'delivered']) ? 'active' : 'inactive' }}">3</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Shipped</div>
                        @if($order->shipped_date)
                            <div class="timeline-date">{{ $order->shipped_date->format('d M Y H:i') }}</div>
                            <div class="timeline-description">Your order has been shipped and is on the way.</div>
                        @elseif($order->status === 'shipped')
                            <div class="timeline-date">Recently shipped</div>
                            <div class="timeline-description">Your order is on the way to your address.</div>
                        @else
                            <div class="timeline-date">Pending</div>
                            <div class="timeline-description">Your order will be shipped once processing is complete.</div>
                        @endif
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot {{ $order->status === 'delivered' ? 'active' : 'inactive' }}">4</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Delivered</div>
                        @if($order->delivered_date)
                            <div class="timeline-date">{{ $order->delivered_date->format('d M Y H:i') }}</div>
                            <div class="timeline-description">Your order has been successfully delivered.</div>
                        @elseif($order->status === 'delivered')
                            <div class="timeline-date">Recently delivered</div>
                            <div class="timeline-description">Your order has been delivered to your address.</div>
                        @else
                            <div class="timeline-date">Pending</div>
                            <div class="timeline-description">Your order will be delivered once shipped.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="order-card">
            <h2 class="card-title">Order Items</h2>
            <div class="order-items">
                @foreach($order->orderItems as $item)
                <div class="item-row">
                    @if($item->product && $item->product->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" 
                             alt="{{ $item->product_name }}" class="item-image">
                    @else
                        <div class="item-image" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999; font-size: 12px;">No Image</div>
                    @endif
                    
                    <div class="item-details">
                        <div class="item-name">{{ $item->product_name }}</div>
                        <div class="item-info">
                            Quantity: {{ $item->kuantitas }}
                            @if($item->size) | Size: {{ $item->size }} @endif
                        </div>
                    </div>
                    
                    <div class="item-price">
                        <div class="item-unit-price">IDR {{ number_format($item->product_price, 0, ',', '.') }} each</div>
                        <div class="item-subtotal">IDR {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
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
                    <span>Shipping Cost</span>
                    <span>IDR {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row total">
                    <span>Total Amount</span>
                    <span>IDR {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="order-actions">
                @if($order->payment_status === 'pending' && $order->payment_method !== 'cod')
                    <a href="#" class="btn btn-warning" onclick="completePayment('{{ $order->order_number }}')">
                        Complete Payment
                    </a>
                @endif
                
                @if(in_array($order->status, ['pending', 'processing']))
                    <button class="btn btn-danger" onclick="cancelOrder('{{ $order->id }}')">
                        Cancel Order
                    </button>
                @endif
                
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    Back to Orders
                </a>
                
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function completePayment(orderNumber) {
    alert('Payment feature will be implemented here for order: ' + orderNumber);
}

function cancelOrder(orderId) {
    if (confirm('Are you sure you want to cancel this order? This action cannot be undone.')) {
        fetch(`/orders/${orderId}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Failed to cancel order');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to cancel order');
        });
    }
}

// Auto refresh order status every 30 seconds
setInterval(function() {
    const orderNumber = '{{ $order->order_number }}';
    fetch(`/orders/${orderNumber}/status`)
        .then(response => response.json())
        .then(data => {
            // Update status badges if they've changed
            const statusBadges = document.querySelectorAll('.status-badge');
            statusBadges.forEach(badge => {
                if (badge.classList.contains('status-' + data.status)) {
                    badge.textContent = data.status_label;
                }
                if (badge.classList.contains('payment-' + data.payment_status)) {
                    badge.textContent = data.payment_status_label;
                }
            });

            // Update timeline if needed
            updateTimeline(data);
        })
        .catch(error => console.log('Status check failed:', error));
}, 30000);

function updateTimeline(data) {
    // Update timeline based on current status
    const timelineDots = document.querySelectorAll('.timeline-dot');
    
    // Reset all dots to inactive
    timelineDots.forEach(dot => {
        dot.classList.remove('active');
        dot.classList.add('inactive');
    });
    
    // Activate dots based on status
    if (data.status === 'processing' || data.status === 'shipped' || data.status === 'delivered') {
        timelineDots[0].classList.add('active');
        timelineDots[1].classList.add('active');
    }
    
    if (data.status === 'shipped' || data.status === 'delivered') {
        timelineDots[2].classList.add('active');
    }
    
    if (data.status === 'delivered') {
        timelineDots[3].classList.add('active');
    }
}
</script>
@endsection