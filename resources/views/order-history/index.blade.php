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

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 14px;
        }

        .filters {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }

        .filter-group input,
        .filter-group select {
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
            height: fit-content;
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

        .delivery-badge {
            background: #d4edda;
            color: #155724;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .order-total {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            text-align: right;
        }

        .order-items {
            margin: 15px 0;
        }

        .item-row {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
            position: relative;
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
            margin-bottom: 3px;
            font-size: 15px;
        }

        .item-info {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .item-price {
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }

        .review-status {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        .review-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .review-completed {
            background: #d4edda;
            color: #155724;
        }

        .review-pending {
            background: #fff3cd;
            color: #856404;
        }

        .stars {
            color: #ffc107;
            font-size: 14px;
            margin-top: 3px;
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

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
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

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
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

            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter-row {
                grid-template-columns: 1fr;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-actions {
                justify-content: flex-start;
            }

            .btn {
                flex: 1;
                justify-content: center;
            }

            .item-row {
                flex-wrap: wrap;
            }

            .review-status {
                position: static;
                transform: none;
                margin-top: 10px;
            }
        }

        .alert {
            padding: 12px 20px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 8px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
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
            <p class="page-subtitle">Track and manage all your orders</p>
        </div>

        <!-- Navigation Tabs -->
        <div class="nav-tabs">
            <a href="{{ route('orders.index') }}" class="nav-tab">Active Orders</a>
            <a href="{{ route('order-history.index') }}" class="nav-tab active">Order History</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <!-- Statistics -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-number">{{ $orders->total() }}</div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    {{ $orders->sum(function ($order) {return $order->orderItems->sum('kuantitas');}) }}</div>
                <div class="stat-label">Items Purchased</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    {{ $orders->sum(function ($order) {return $order->orderItems->where('review', '!=', null)->count();}) }}
                </div>
                <div class="stat-label">Reviews Given</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">IDR {{ number_format($orders->sum('grand_total'), 0, ',', '.') }}</div>
                <div class="stat-label">Total Spent</div>
            </div>
        </div>

        <!-- Filters -->
        <form method="GET" action="{{ route('order-history.index') }}" class="filters">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="date_from">From Date</label>
                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}">
                </div>
                <div class="filter-group">
                    <label for="date_to">To Date</label>
                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}">
                </div>
                <div class="filter-group">
                    <label for="rating">Rating</label>
                    <select name="rating" id="rating">
                        <option value="">All Ratings</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="review_status">Review Status</label>
                    <select name="review_status" id="review_status">
                        <option value="">All Items</option>
                        <option value="reviewed" {{ request('review_status') == 'reviewed' ? 'selected' : '' }}>Reviewed
                        </option>
                        <option value="unreviewed" {{ request('review_status') == 'unreviewed' ? 'selected' : '' }}>
                            Unreviewed</option>
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
                                    <div>Delivered: {{ $order->delivered_date->format('d M Y H:i') }}</div>
                                    <div>{{ $order->orderItems->sum('kuantitas') }} items</div>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <div class="delivery-badge">
                                    ✓ Delivered
                                </div>
                                <div class="order-total">IDR {{ number_format($order->grand_total, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <!-- Order Items with Reviews -->
                        <div class="order-items">
                            @foreach ($order->orderItems as $item)
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
                                        <div class="item-price">IDR {{ number_format($item->subtotal, 0, ',', '.') }}</div>

                                        @if ($item->review)
                                            <div class="stars">
                                                {{ str_repeat('★', $item->review->rating) }}{{ str_repeat('☆', 5 - $item->review->rating) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="review-status">
                                        @if ($item->review)
                                            <div class="review-badge review-completed">Reviewed</div>
                                            <div style="margin-top: 5px;">
                                                <a href="{{ route('order-history.edit-review', $item->review->id) }}"
                                                    class="btn btn-warning btn-sm">Edit Review</a>
                                            </div>
                                        @else
                                            <div class="review-badge review-pending">Not Reviewed</div>
                                            <div style="margin-top: 5px;">
                                                <a href="{{ route('order-history.review-form', $item->id) }}"
                                                    class="btn btn-success btn-sm">Write Review</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Actions -->
                        <div class="order-actions">
                            <a href="{{ route('order-history.show', $order->order_number) }}" class="btn btn-primary">
                                View Details
                            </a>
                            <a href="{{ route('orders.show', $order->order_number) }}" class="btn btn-primary">
                                Order Receipt
                            </a>
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
                <h2 class="empty-title">No Order History</h2>
                <p class="empty-text">You don't have any delivered orders yet. Complete some orders to see your history
                    here.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Start Shopping</a>
            </div>
        @endif
    </div>
@endsection
