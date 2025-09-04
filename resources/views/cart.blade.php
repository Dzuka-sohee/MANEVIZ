@extends('layouts.app2')

@section('content')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
                <!-- Shadowtech Eclipse Sneakers -->
                <div class="cart-item">
                    <div class="item-checkbox">
                        <input type="checkbox" checked>
                    </div>
                    <div class="item-image">
                        <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=200&h=200&fit=crop&crop=center" alt="Shadowtech Eclipse Sneakers">
                    </div>
                    <div class="item-details">
                        <h3 class="item-name">Shadowtech Eclipse Sneakers</h3>
                        <div class="item-options">
                            <div class="option-group">
                                <div class="option-circle"></div>
                                <span class="option-text">Black</span>
                            </div>
                            <div class="option-group">
                                <span class="option-text">US 8</span>
                            </div>
                        </div>
                        <a href="#" class="move-to-favorites">Move to Favorites</a>
                    </div>
                    <div class="item-controls">
                        <button class="remove-btn">&times;</button>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="decreaseQuantity(this)">-</button>
                            <input type="text" class="quantity-input" value="1" readonly>
                            <button class="quantity-btn" onclick="increaseQuantity(this)">+</button>
                        </div>
                        <div class="item-price">$120.53</div>
                    </div>
                </div>

                <!-- Neonoir Vanguard Boots -->
                <div class="cart-item">
                    <div class="item-checkbox">
                        <input type="checkbox">
                    </div>
                    <div class="item-image">
                        <img src="https://images.unsplash.com/photo-1544966503-7cc5ac882d5e?w=200&h=200&fit=crop&crop=center" alt="Neonoir Vanguard Boots">
                    </div>
                    <div class="item-details">
                        <h3 class="item-name">Neonoir Vanguard Boots</h3>
                        <div class="item-options">
                            <div class="option-group">
                                <div class="option-circle"></div>
                                <span class="option-text">Black</span>
                            </div>
                            <div class="option-group">
                                <span class="option-text">US 8</span>
                            </div>
                        </div>
                        <a href="#" class="move-to-favorites">Move to Favorites</a>
                    </div>
                    <div class="item-controls">
                        <button class="remove-btn">&times;</button>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="decreaseQuantity(this)">-</button>
                            <input type="text" class="quantity-input" value="1" readonly>
                            <button class="quantity-btn" onclick="increaseQuantity(this)">+</button>
                        </div>
                        <div class="item-price">$210.14</div>
                    </div>
                </div>

                <!-- Cybergoth Stealth Kicks -->
                <div class="cart-item">
                    <div class="item-checkbox">
                        <input type="checkbox">
                    </div>
                    <div class="item-image">
                        <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=200&h=200&fit=crop&crop=center" alt="Cybergoth Stealth Kicks">
                    </div>
                    <div class="item-details">
                        <h3 class="item-name">Cybergoth Stealth Kicks</h3>
                        <div class="item-options">
                            <div class="option-group">
                                <div class="option-circle"></div>
                                <span class="option-text">Black</span>
                            </div>
                            <div class="option-group">
                                <span class="option-text">US 8</span>
                            </div>
                        </div>
                        <a href="#" class="move-to-favorites">Move to Favorites</a>
                    </div>
                    <div class="item-controls">
                        <button class="remove-btn">&times;</button>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="decreaseQuantity(this)">-</button>
                            <input type="text" class="quantity-input" value="1" readonly>
                            <button class="quantity-btn" onclick="increaseQuantity(this)">+</button>
                        </div>
                        <div class="item-price">$154.32</div>
                    </div>
                </div>
            </div>

            <div class="order-summary">
                <h3 class="summary-title">Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotal">$120.53</span>
                </div>
                <div class="summary-row">
                    <span>Tax</span>
                    <span id="tax">$3</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="total">$123.53</span>
                </div>
                <button class="checkout-btn">Checkout</button>
            </div>
        </div>
    </div>

    <script>
        function increaseQuantity(btn) {
            const input = btn.previousElementSibling;
            const currentValue = parseInt(input.value);
            input.value = currentValue + 1;
            updateItemTotal(btn);
        }

        function decreaseQuantity(btn) {
            const input = btn.nextElementSibling;
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateItemTotal(btn);
            }
        }

        function updateItemTotal(btn) {
            const cartItem = btn.closest('.cart-item');
            const quantity = parseInt(cartItem.querySelector('.quantity-input').value);
            const priceElement = cartItem.querySelector('.item-price');
            const priceText = priceElement.textContent;
            
            // Extract base price (divide current price by current quantity to get unit price)
            const currentQuantity = quantity - (btn.textContent === '+' ? 1 : -1);
            const currentPrice = parseFloat(priceText.replace('$', ''));
            const unitPrice = currentQuantity > 0 ? currentPrice / currentQuantity : currentPrice;
            
            // Calculate new total
            const newTotal = (unitPrice * quantity).toFixed(2);
            priceElement.textContent = `$${newTotal}`;

            updateOrderSummary();
        }

        function updateOrderSummary() {
            const checkedItems = document.querySelectorAll('.item-checkbox input:checked');
            let subtotal = 0;

            checkedItems.forEach(checkbox => {
                const cartItem = checkbox.closest('.cart-item');
                const priceText = cartItem.querySelector('.item-price').textContent;
                const price = parseFloat(priceText.replace('$', ''));
                subtotal += price;
            });

            const tax = subtotal * 0.025;
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }

        // Add event listeners for checkboxes
        document.querySelectorAll('.item-checkbox input').forEach(checkbox => {
            checkbox.addEventListener('change', updateOrderSummary);
        });

        // Add event listeners for remove buttons
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.cart-item').remove();
                updateOrderSummary();
            });
        });

        // Initialize order summary
        updateOrderSummary();
    </script>
@endsection
