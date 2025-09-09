@extends('layouts.app2')

@section('content')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px;
        }

        .cart-header {
            padding: 20px 0;
        }

        .cart-title {
            font-size: clamp(20px, 4vw, 28px);
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
            margin-top: 100px;
        }

        .cart-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .cart-items {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-cart h3 {
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .empty-cart a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .cart-item {
            display: grid;
            grid-template-columns: auto 80px 1fr auto;
            grid-template-rows: auto auto;
            gap: 15px;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            align-items: flex-start;
            position: relative;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-checkbox {
            grid-column: 1;
            grid-row: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .item-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #333;
        }

        .item-image {
            grid-column: 2;
            grid-row: 1 / 3;
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            grid-column: 3;
            grid-row: 1;
            min-width: 0;
        }

        .item-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
            color: #333;
        }

        .item-options {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
            flex-wrap: wrap;
        }

        .option-group {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .option-circle {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #000;
            border: 2px solid #ddd;
            flex-shrink: 0;
        }

        .option-text {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
        }

        .move-to-favorites {
            color: #666;
            font-size: 11px;
            text-transform: uppercase;
            text-decoration: none;
            transition: color 0.2s;
        }

        .move-to-favorites:hover {
            color: #333;
        }

        .item-controls {
            grid-column: 3 / 5;
            grid-row: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }

        .remove-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #999;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .remove-btn:hover {
            color: #dc3545;
            background-color: #f8f9fa;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
        }

        .quantity-btn {
            background: none;
            border: none;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s;
        }

        .quantity-btn:hover {
            background-color: #f8f9fa;
        }

        .quantity-input {
            border: none;
            width: 40px;
            text-align: center;
            font-size: 14px;
            padding: 6px 0;
            background: transparent;
        }

        .item-price {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .order-summary {
            background: white;
            border-radius: 12px;
            padding: 25px;
            height: fit-content;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 20px;
            color: #666;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .summary-row.total {
            font-weight: bold;
            font-size: 16px;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
            margin-top: 15px;
        }

        .checkout-btn {
            width: 100%;
            background-color: #333;
            color: white;
            border: none;
            padding: 15px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 20px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .checkout-btn:hover {
            background-color: #555;
            transform: translateY(-2px);
        }

        /* Tablet styles */
        @media (min-width: 768px) {
            .container {
                padding: 20px;
            }

            .cart-content {
                grid-template-columns: 2fr 1fr;
                gap: 30px;
            }

            .cart-title {
                text-align: left;
            }

            .cart-item {
                grid-template-columns: auto 120px 1fr auto;
                grid-template-rows: auto;
                gap: 20px;
                padding: 25px;
                align-items: center;
            }

            .item-checkbox {
                grid-row: 1;
            }

            .item-image {
                grid-row: 1;
                width: 120px;
                height: 120px;
            }

            .item-details {
                grid-row: 1;
            }

            .item-controls {
                grid-column: 4;
                grid-row: 1;
                flex-direction: column;
                align-items: flex-end;
                justify-content: space-between;
                margin-top: 0;
                min-height: 120px;
            }

            .quantity-controls {
                order: 2;
            }

            .item-price {
                order: 3;
            }

            .remove-btn {
                order: 1;
            }
        }

        /* Mobile styles */
        @media (max-width: 767px) {
            .container {
                padding: 10px;
            }

            .cart-header {
                padding: 15px 0;
                margin-bottom: 15px;
            }

            .cart-item {
                padding: 15px;
                gap: 12px;
            }

            .item-name {
                font-size: 14px;
            }

            .option-text {
                font-size: 11px;
            }

            .move-to-favorites {
                font-size: 10px;
            }

            .item-price {
                font-size: 14px;
            }

            .quantity-btn {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

            .quantity-input {
                width: 35px;
                font-size: 12px;
            }

            .order-summary {
                padding: 20px;
                margin-top: 10px;
            }
        }

        /* Small mobile styles */
        @media (max-width: 480px) {
            .cart-item {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto auto auto;
                text-align: left;
                gap: 15px;
                padding: 15px;
            }

            .item-checkbox {
                grid-column: 1;
                grid-row: 1;
                justify-self: start;
            }

            .item-image {
                grid-column: 1;
                grid-row: 2;
                justify-self: center;
                width: 100px;
                height: 100px;
            }

            .item-details {
                grid-column: 1;
                grid-row: 3;
                text-align: center;
            }

            .item-controls {
                grid-column: 1;
                grid-row: 4;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                gap: 15px;
                margin-top: 10px;
            }

            .remove-btn {
                order: 3;
            }

            .quantity-controls {
                order: 1;
            }

            .item-price {
                order: 2;
            }
        }

        /* Very small screens */
        @media (max-width: 360px) {
            .container {
                padding: 8px;
            }

            .cart-item {
                padding: 12px;
            }

            .order-summary {
                padding: 15px;
            }

            .checkout-btn {
                padding: 12px;
                font-size: 12px;
            }
        }

        /* Touch improvements */
        @media (hover: none) {
            .quantity-btn, .remove-btn, .move-to-favorites {
                min-height: 44px;
                min-width: 44px;
            }
        }
    </style>

    <div class="cart-header">
        <div class="container">
            <h1 class="cart-title">Shopping Cart</h1>
        </div>
    </div>

    <div class="container">
        <div class="cart-content">
            <div class="cart-items">
                @if($cartItems->count() > 0)
                    @foreach($cartItems as $item)
                        <div class="cart-item" data-cart-id="{{ $item->id }}">
                            <div class="item-checkbox">
                                <input type="checkbox" class="cart-checkbox" data-price="{{ $item->product->harga_jual ?? $item->product->harga }}" data-quantity="{{ $item->kuantitas }}" checked>
                            </div>
                            <div class="item-image">
                                @if($item->product->images && $item->product->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                                @endif
                            </div>
                            <div class="item-details">
                                <h3 class="item-name">{{ $item->product->name }}</h3>
                                <div class="item-options">
                                    @if($item->color)
                                        <div class="option-group">
                                            <div class="option-circle" style="background-color: {{ $item->color === 'Black' ? '#000' : ($item->color === 'White' ? '#fff' : '#6c757d') }}; {{ $item->color === 'White' ? 'border: 2px solid #ddd;' : '' }}"></div>
                                            <span class="option-text">{{ $item->color }}</span>
                                        </div>
                                    @endif
                                    @if($item->size)
                                        <div class="option-group">
                                            <span class="option-text">{{ $item->size }}</span>
                                        </div>
                                    @endif
                                </div>
                                <a href="#" class="move-to-favorites">Move to Favorites</a>
                            </div>
                            <div class="item-controls">
                                <button class="remove-btn" onclick="removeItem({{ $item->id }})">&times;</button>
                                <div class="quantity-controls">
                                    <button class="quantity-btn" onclick="decreaseQuantity({{ $item->id }})">-</button>
                                    <input type="text" class="quantity-input" value="{{ $item->kuantitas }}" readonly>
                                    <button class="quantity-btn" onclick="increaseQuantity({{ $item->id }})">+</button>
                                </div>
                                <div class="item-price">IDR {{ number_format(($item->product->harga_jual ?? $item->product->harga) * $item->kuantitas, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-cart">
                        <h3>Keranjang Belanja Kosong</h3>
                        <p>Belum ada produk di keranjang Anda.</p>
                        <a href="{{ route('products.index') }}">Mulai Belanja Sekarang</a>
                    </div>
                @endif
            </div>

            @if($cartItems->count() > 0)
                <div class="order-summary">
                    <h3 class="summary-title">Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="subtotal">IDR 0</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (2.5%)</span>
                        <span id="tax">IDR 0</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="total">IDR 0</span>
                    </div>
                    <button class="checkout-btn" onclick="proceedToCheckout()">Checkout</button>
                </div>
            @endif
        </div>
    </div>

    <script>
        function increaseQuantity(cartId) {
            const cartItem = document.querySelector(`[data-cart-id="${cartId}"]`);
            const quantityInput = cartItem.querySelector('.quantity-input');
            const currentValue = parseInt(quantityInput.value);
            
            updateQuantity(cartId, currentValue + 1);
        }

        function decreaseQuantity(cartId) {
            const cartItem = document.querySelector(`[data-cart-id="${cartId}"]`);
            const quantityInput = cartItem.querySelector('.quantity-input');
            const currentValue = parseInt(quantityInput.value);
            
            if (currentValue > 1) {
                updateQuantity(cartId, currentValue - 1);
            }
        }

        function updateQuantity(cartId, newQuantity) {
            fetch(`/cart/update/${cartId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    kuantitas: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartItem = document.querySelector(`[data-cart-id="${cartId}"]`);
                    const quantityInput = cartItem.querySelector('.quantity-input');
                    const priceElement = cartItem.querySelector('.item-price');
                    const checkbox = cartItem.querySelector('.cart-checkbox');
                    
                    quantityInput.value = newQuantity;
                    priceElement.textContent = `IDR ${data.new_total.toLocaleString('id-ID')}`;
                    checkbox.setAttribute('data-quantity', newQuantity);
                    
                    updateOrderSummary();
                    showNotification('success', data.message);
                } else {
                    showNotification('error', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', 'Terjadi kesalahan saat mengupdate kuantitas');
            });
        }

        function removeItem(cartId) {
            if (confirm('Yakin ingin menghapus item ini dari keranjang?')) {
                fetch(`/cart/remove/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`[data-cart-id="${cartId}"]`).remove();
                        updateOrderSummary();
                        showNotification('success', data.message);
                        
                        // Check if cart is empty
                        if (document.querySelectorAll('.cart-item').length === 0) {
                            location.reload();
                        }
                    } else {
                        showNotification('error', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('error', 'Terjadi kesalahan saat menghapus item');
                });
            }
        }

        function updateOrderSummary() {
            const checkedItems = document.querySelectorAll('.cart-checkbox:checked');
            let subtotal = 0;

            checkedItems.forEach(checkbox => {
                const price = parseFloat(checkbox.getAttribute('data-price'));
                const quantity = parseInt(checkbox.getAttribute('data-quantity'));
                subtotal += price * quantity;
            });

            const tax = subtotal * 0.025;
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = `IDR ${subtotal.toLocaleString('id-ID')}`;
            document.getElementById('tax').textContent = `IDR ${Math.round(tax).toLocaleString('id-ID')}`;
            document.getElementById('total').textContent = `IDR ${Math.round(total).toLocaleString('id-ID')}`;
        }

        function proceedToCheckout() {
            const checkedItems = document.querySelectorAll('.cart-checkbox:checked');
            
            if (checkedItems.length === 0) {
                showNotification('error', 'Pilih minimal satu item untuk checkout');
                return;
            }

            // Collect selected item IDs
            const selectedItemIds = Array.from(checkedItems).map(checkbox => {
                return checkbox.closest('.cart-item').getAttribute('data-cart-id');
            });

            // Redirect to checkout with selected items
            window.location.href = `/checkout?items=${selectedItemIds.join(',')}`;
        }

        function showNotification(type, message) {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
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
                ${type === 'success' ? 'background: #28a745;' : 'background: #dc3545;'}
            `;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Add event listeners for checkboxes
        document.querySelectorAll('.cart-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateOrderSummary);
        });

        // Initialize order summary
        updateOrderSummary();
    </script>
@endsection