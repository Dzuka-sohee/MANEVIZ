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
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .cart-header {
            padding-top: 20px;
            margin-bottom: 10px;
            margin-top: 60px;
        }

        .cart-title {
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cart-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            align-items: start;
        }

        .cart-items {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .cart-item {
            display: grid;
            grid-template-columns: auto auto 1fr auto;
            gap: 20px;
            padding: 25px;
            border-bottom: 1px solid #e9ecef;
            align-items: center;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-checkbox {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .item-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .item-image {
            width: 120px;
            height: 120px;
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
            min-width: 0; /* Allow text to wrap properly */
        }

        .item-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .item-options {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .option-group {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .option-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #000;
            border: 2px solid #ddd;
            flex-shrink: 0;
        }

        .option-text {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
        }

        .move-to-favorites {
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }

        .move-to-favorites:hover {
            color: #333;
        }

        .item-controls {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 15px;
            min-width: 150px;
        }

        .remove-btn {
            background: none;
            border: none;
            font-size: 18px;
            color: #999;
            cursor: pointer;
            padding: 5px;
        }

        .remove-btn:hover {
            color: #dc3545;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .quantity-btn {
            background: none;
            border: none;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
        }

        .quantity-btn:hover {
            background-color: #f8f9fa;
        }

        .quantity-input {
            border: none;
            width: 50px;
            text-align: center;
            font-size: 14px;
            padding: 8px 0;
        }

        .item-price {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .order-summary {
            background: white;
            border-radius: 8px;
            padding: 25px;
            height: fit-content;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
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
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: #555;
        }

        @media (max-width: 768px) {
            .cart-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .cart-item {
                grid-template-columns: auto 1fr;
                grid-template-rows: auto auto;
                gap: 15px;
                padding: 20px;
            }

            .item-checkbox {
                grid-column: 1;
                grid-row: 1;
                align-self: start;
                margin-top: 10px;
            }

            .item-image {
                grid-column: 1;
                grid-row: 2;
                width: 100px;
                height: 100px;
                margin: 0;
            }

            .item-details {
                grid-column: 2;
                grid-row: 1 / 3;
                padding-left: 15px;
            }

            .item-controls {
                grid-column: 1 / 3;
                grid-row: 3;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                margin-top: 15px;
                min-width: auto;
            }

            .item-controls .remove-btn {
                order: 3;
            }

            .item-controls .quantity-controls {
                order: 1;
            }

            .item-controls .item-price {
                order: 2;
            }
        }

        @media (max-width: 480px) {
            .cart-item {
                grid-template-columns: 1fr;
                text-align: left;
                gap: 15px;
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
                margin: 10px 0;
            }

            .item-details {
                grid-column: 1;
                grid-row: 3;
                padding-left: 0;
                text-align: center;
            }

            .item-controls {
                grid-column: 1;
                grid-row: 4;
                justify-content: center;
                gap: 20px;
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
            // Get the cart item container
            const cartItem = btn.closest('.cart-item');
            const quantity = parseInt(cartItem.querySelector('.quantity-input').value);
            const priceText = cartItem.querySelector('.item-price').textContent;
            const basePrice = parseFloat(priceText.replace('$', ''));

            // Update the item price display
            const newTotal = (basePrice * quantity).toFixed(2);
            cartItem.querySelector('.item-price').textContent = `$${newTotal}`;

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

            const tax = subtotal * 0.025; // 2.5% tax rate
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
