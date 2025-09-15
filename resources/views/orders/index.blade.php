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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            margin: 80px 0 40px;
            text-align: center;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .filters {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .filter-row {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }

        .filter-group select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: white;
        }

        .btn-filter {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn-filter:hover {
            background: #0056b3;
        }

        .orders-grid {
            display: grid;
            gap: 20px;
        }

        .order-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .order-info h3 {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .order-meta {
            font-size: 14px;
            color: #6c757d;
        }

        .order-status {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background: #cce5ff;
            color: #004085;
        }

        .status-shipped {
            background: #d4edda;
            color: #155724;
        }

        .status-delivered {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .payment-paid {
            background: #d4edda;
            color: #155724;
        }

        .payment-pending {
            background: #fff3cd;
            color: #856404;
        }

        .payment-failed {
            background: #f8d7da;
            color: #721c24;
        }

        .order-total {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        .order-items {
            margin: 15px 0;
        }

        .item-row {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 50px;
            height: 50px;
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
            margin-bottom: 3px;
            font-size: 14px;
        }

        .item-info {
            font-size: 12px;
            color: #6c757d;
        }

        .item-price {
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }

        .order-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
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

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
            color: #6c757d;
        }

        .empty-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .empty-text {
            color: #6c757d;
            margin-bottom: 30px;
        }

        .tracking-timeline {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .timeline-dot.active {
            background: #28a745;
        }

        .timeline-dot.inactive {
            background: #dee2e6;
        }

        .pagination-wrapper {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .page-title {
                font-size: 2rem;
            }

            .filter-row {
                flex-direction: column;
                align-items: stretch;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-status {
                align-items: flex-start;
            }

            .order-actions {
                justify-content: flex-start;
            }

            .btn {
                flex: 1;
                justify-content: center;
                min-width: auto;
            }
        }

        .nav-tabs {
            display: flex;
            justify-content: center;
            margin: 20px 0 40px;
            border-bottom: 2px solid #e1e5e9;
        }

        .nav-tab {
            padding: 12px 24px;
            text-decoration: none;
            color: #6c757d;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            margin: 0 10px;
        }

        .nav-tab:hover {
            color: #007bff;
            text-decoration: none;
        }

        .nav-tab.active {
            color: #007bff;
            border-bottom-color: #007bff;
        }
    </style>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">My Orders</h1>
            <p class="page-subtitle">Track and manage your orders</p>
        </div>

        <!-- Navigation Tabs -->
        <div class="nav-tabs">
            <a href="{{ route('orders.index') }}" class="nav-tab active">Active Orders</a>
            <a href="{{ route('order-history.index') }}" class="nav-tab">Order History</a>
        </div>

        <!-- Info Message -->
        <div
            style="background: #e7f3ff; border-left: 4px solid #007bff; padding: 15px; margin-bottom: 30px; border-radius: 0 8px 8px 0;">
            <div style="display: flex; align-items: center; gap: 10px; color: #004085;">
                <span style="font-size: 18px;">ℹ️</span>
                <div>
                    <strong>Looking for completed orders?</strong><br>
                    <small>Delivered orders have been moved to <a href="{{ route('order-history.index') }}"
                            style="color: #007bff; text-decoration: underline;">Order History</a> where you can leave
                        reviews.</small>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <form method="GET" action="{{ route('orders.index') }}" class="filters">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="status">Order Status</label>
                    <select name="status" id="status">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing
                        </option>
                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered
                        </option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                        </option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" id="payment_status">
                        <option value="">All Payment Status</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending
                        </option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn-filter">Filter</button>
            </div>
        </form>

        <!-- Orders List -->
        @if ($orders->count() > 0)
            <div class="orders-grid">
                @foreach ($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-info">
                                <h3>{{ $order->order_number }}</h3>
                                <div class="order-meta">
                                    <div>Order Date: {{ $order->order_date->format('d M Y H:i') }}</div>
                                    <div>{{ $order->orderItems->sum('kuantitas') }} items</div>
                                </div>
                            </div>
                            <div class="order-status">
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ $order->getStatusLabelAttribute() }}
                                </span>
                                <span class="status-badge payment-{{ $order->payment_status }}">
                                    {{ $order->getPaymentStatusLabelAttribute() }}
                                </span>
                                <div class="order-total">IDR {{ number_format($order->grand_total, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div class="order-items">
                            @foreach ($order->orderItems->take(2) as $item)
                                <div class="item-row">
                                    @if ($item->product && $item->product->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                            alt="{{ $item->product_name }}" class="item-image">
                                    @else
                                        <div class="item-image"
                                            style="background: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999; font-size: 12px;">
                                            No Image</div>
                                    @endif
                                    <div class="item-details">
                                        <div class="item-name">{{ $item->product_name }}</div>
                                        <div class="item-info">
                                            Qty: {{ $item->kuantitas }}
                                            @if ($item->size)
                                                | Size: {{ $item->size }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item-price">IDR {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                                </div>
                            @endforeach
                            @if ($order->orderItems->count() > 2)
                                <div style="text-align: center; color: #6c757d; font-size: 13px; margin-top: 10px;">
                                    +{{ $order->orderItems->count() - 2 }} more items
                                </div>
                            @endif
                        </div>

                        <!-- Tracking Timeline -->
                        @if (in_array($order->status, ['processing', 'shipped', 'delivered']))
                            <div class="tracking-timeline">
                                <div class="timeline-item">
                                    <div class="timeline-dot active"></div>
                                    <span>Order Confirmed - {{ $order->order_date->format('d M Y H:i') }}</span>
                                </div>
                                <div class="timeline-item">
                                    <div
                                        class="timeline-dot {{ $order->status === 'processing' || $order->status === 'shipped' || $order->status === 'delivered' ? 'active' : 'inactive' }}">
                                    </div>
                                    <span>Processing</span>
                                </div>
                                <div class="timeline-item">
                                    <div
                                        class="timeline-dot {{ $order->status === 'shipped' || $order->status === 'delivered' ? 'active' : 'inactive' }}">
                                    </div>
                                    <span>Shipped
                                        {{ $order->shipped_date ? '- ' . $order->shipped_date->format('d M Y H:i') : '' }}</span>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot {{ $order->status === 'delivered' ? 'active' : 'inactive' }}">
                                    </div>
                                    <span>Delivered
                                        {{ $order->delivered_date ? '- ' . $order->delivered_date->format('d M Y H:i') : '' }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="order-actions">
                            <a href="{{ route('orders.show', $order->order_number) }}" class="btn btn-primary">
                                View Details
                            </a>

                            @if ($order->payment_status === 'pending' && $order->payment_method !== 'cod')
                                <a href="#" class="btn btn-warning"
                                    onclick="completePayment('{{ $order->order_number }}')">
                                    Complete Payment
                                </a>
                            @endif

                            @if (in_array($order->status, ['pending', 'processing']))
                                <button class="btn btn-danger" onclick="cancelOrder('{{ $order->id }}')">
                                    Cancel Order
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($orders->hasPages())
                <div class="pagination-wrapper">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon">📦</div>
                <h2 class="empty-title">No Orders Found</h2>
                <p class="empty-text">You haven't placed any orders yet. Start shopping to see your orders here.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Start Shopping</a>
            </div>
        @endif
    </div>

    <script>
        function completePayment(orderNumber) {
            // Redirect to payment page or open payment modal
            alert('Payment feature will be implemented here for order: ' + orderNumber);
        }

        function cancelOrder(orderId) {
            if (confirm('Are you sure you want to cancel this order?')) {
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
            const orderCards = document.querySelectorAll('.order-card');
            orderCards.forEach(card => {
                const orderNumber = card.querySelector('h3').textContent;
                if (orderNumber) {
                    fetch(`/orders/${orderNumber}/status`)
                        .then(response => response.json())
                        .then(data => {
                            // Update status badges if they've changed
                            const statusBadge = card.querySelector('.status-' + data.status.replace('_',
                                '-'));
                            if (statusBadge) {
                                statusBadge.textContent = data.status_label;
                            }
                        })
                        .catch(error => console.log('Status check failed:', error));
                }
            });
        }, 30000);
    </script>
@endsection
