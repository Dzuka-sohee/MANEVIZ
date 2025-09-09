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
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .checkout-header {
        text-align: center;
        margin: 100px 0 40px;
    }

    .checkout-title {
        font-size: 2.5rem;
        font-weight: bold;
        text-transform: uppercase;
        color: #333;
        margin-bottom: 10px;
    }

    .checkout-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
    }

    .checkout-content {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 40px;
        margin-top: 40px;
    }

    .checkout-form {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .form-section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #333;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 15px 0;
    }

    .checkbox-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #333;
    }

    .checkbox-label {
        font-size: 14px;
        color: #333;
        cursor: pointer;
    }

    .payment-methods {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .payment-method {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
    }

    .payment-method:hover {
        border-color: #333;
    }

    .payment-method.selected {
        border-color: #333;
        background-color: #f8f9fa;
    }

    .payment-method input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .payment-icon {
        font-size: 24px;
        margin-bottom: 8px;
    }

    .payment-name {
        font-weight: 600;
        font-size: 14px;
        color: #333;
    }

    .order-summary {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .summary-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 10px;
    }

    .order-item {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .item-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
        background: #f8f9fa;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        font-size: 14px;
        color: #333;
        margin-bottom: 5px;
    }

    .item-options {
        display: flex;
        gap: 10px;
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .item-price {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .summary-row.total {
        font-weight: bold;
        font-size: 18px;
        padding-top: 15px;
        border-top: 2px solid #f8f9fa;
        margin-top: 20px;
        color: #333;
    }

    .place-order-btn {
        width: 100%;
        background: #333;
        color: white;
        border: none;
        padding: 16px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .place-order-btn:hover:not(:disabled) {
        background: #555;
        transform: translateY(-2px);
    }

    .place-order-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: none;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 14px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .back-to-cart {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #6c757d;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 20px;
        transition: color 0.3s ease;
    }

    .back-to-cart:hover {
        color: #333;
        text-decoration: none;
    }

    /* Loading spinner */
    .spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
        margin-right: 8px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .checkout-content {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .checkout-form {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .payment-methods {
            grid-template-columns: 1fr;
        }

        .checkout-title {
            font-size: 2rem;
        }

        .container {
            padding: 15px;
        }
    }

    @media (max-width: 480px) {
        .checkout-header {
            margin: 80px 0 30px;
        }

        .checkout-title {
            font-size: 1.8rem;
        }

        .checkout-form {
            padding: 15px;
        }

        .order-summary {
            padding: 20px;
        }
    }
</style>

<div class="container">
    <div class="checkout-header">
        <h1 class="checkout-title">Checkout</h1>
        <p class="checkout-subtitle">Complete your order</p>
    </div>

    <!-- Back to Cart Link -->
    <a href="{{ route('cart.index') }}" class="back-to-cart">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="m12 19-7-7 7-7"/>
            <path d="m19 12-7 7-7-7"/>
        </svg>
        Back to Cart
    </a>

    <!-- Display Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>
            <ul style="margin: 10px 0 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="checkout-content">
        <!-- Checkout Form -->
        <div class="checkout-form">
            <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST">
                @csrf
                
                <!-- Hidden field untuk items -->
                <input type="hidden" name="items" value="{{ $selectedItems->pluck('id')->implode(',') }}">

                <!-- Shipping Information -->
                <div class="form-section">
                    <h3 class="section-title">Shipping Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="shipping_name" class="form-input @error('shipping_name') is-invalid @enderror" 
                                   value="{{ old('shipping_name', auth()->user()->name) }}" required>
                            @error('shipping_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email *</label>
                            <input type="email" name="shipping_email" class="form-input @error('shipping_email') is-invalid @enderror" 
                                   value="{{ old('shipping_email', auth()->user()->email) }}" required>
                            @error('shipping_email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone Number *</label>
                        <input type="tel" name="shipping_phone" class="form-input @error('shipping_phone') is-invalid @enderror" 
                               value="{{ old('shipping_phone') }}" required placeholder="08xxxxxxxxxx">
                        @error('shipping_phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address *</label>
                        <textarea name="shipping_address" class="form-input form-textarea @error('shipping_address') is-invalid @enderror" 
                                  required placeholder="Street address, building, apartment, etc.">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">City *</label>
                            <input type="text" name="shipping_city" class="form-input @error('shipping_city') is-invalid @enderror" 
                                   value="{{ old('shipping_city') }}" required>
                            @error('shipping_city')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Province *</label>
                            <input type="text" name="shipping_province" class="form-input @error('shipping_province') is-invalid @enderror" 
                                   value="{{ old('shipping_province') }}" required>
                            @error('shipping_province')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Postal Code *</label>
                        <input type="text" name="shipping_postal_code" class="form-input @error('shipping_postal_code') is-invalid @enderror" 
                               value="{{ old('shipping_postal_code') }}" required maxlength="10">
                        @error('shipping_postal_code')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Billing Information -->
                <div class="form-section">
                    <h3 class="section-title">Billing Information</h3>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="same_as_shipping" name="same_as_shipping" value="1" 
                               {{ old('same_as_shipping', true) ? 'checked' : '' }} onchange="toggleBillingFields()">
                        <label for="same_as_shipping" class="checkbox-label">Same as shipping address</label>
                    </div>

                    <div id="billing-fields" style="display: {{ old('same_as_shipping', true) ? 'none' : 'block' }};">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="billing_name" class="form-input @error('billing_name') is-invalid @enderror" 
                                       value="{{ old('billing_name') }}">
                                @error('billing_name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="billing_email" class="form-input @error('billing_email') is-invalid @enderror" 
                                       value="{{ old('billing_email') }}">
                                @error('billing_email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="billing_phone" class="form-input @error('billing_phone') is-invalid @enderror" 
                                   value="{{ old('billing_phone') }}">
                            @error('billing_phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea name="billing_address" class="form-input form-textarea @error('billing_address') is-invalid @enderror">{{ old('billing_address') }}</textarea>
                            @error('billing_address')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <input type="text" name="billing_city" class="form-input @error('billing_city') is-invalid @enderror" 
                                       value="{{ old('billing_city') }}">
                                @error('billing_city')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Province</label>
                                <input type="text" name="billing_province" class="form-input @error('billing_province') is-invalid @enderror" 
                                       value="{{ old('billing_province') }}">
                                @error('billing_province')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Postal Code</label>
                            <input type="text" name="billing_postal_code" class="form-input @error('billing_postal_code') is-invalid @enderror" 
                                   value="{{ old('billing_postal_code') }}" maxlength="10">
                            @error('billing_postal_code')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="form-section">
                    <h3 class="section-title">Payment Method</h3>
                    
                    <div class="payment-methods">
                        <label class="payment-method {{ old('payment_method', 'bank_transfer') == 'bank_transfer' ? 'selected' : '' }}">
                            <input type="radio" name="payment_method" value="bank_transfer" 
                                   {{ old('payment_method', 'bank_transfer') == 'bank_transfer' ? 'checked' : '' }}>
                            <div class="payment-icon">🏦</div>
                            <div class="payment-name">Bank Transfer</div>
                        </label>
                        
                        <label class="payment-method {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}">
                            <input type="radio" name="payment_method" value="credit_card" 
                                   {{ old('payment_method') == 'credit_card' ? 'checked' : '' }}>
                            <div class="payment-icon">💳</div>
                            <div class="payment-name">Credit Card</div>
                        </label>
                        
                        <label class="payment-method {{ old('payment_method') == 'ewallet' ? 'selected' : '' }}">
                            <input type="radio" name="payment_method" value="ewallet" 
                                   {{ old('payment_method') == 'ewallet' ? 'checked' : '' }}>
                            <div class="payment-icon">📱</div>
                            <div class="payment-name">E-Wallet</div>
                        </label>
                        
                        <label class="payment-method {{ old('payment_method') == 'cod' ? 'selected' : '' }}">
                            <input type="radio" name="payment_method" value="cod" 
                                   {{ old('payment_method') == 'cod' ? 'checked' : '' }}>
                            <div class="payment-icon">💵</div>
                            <div class="payment-name">Cash on Delivery</div>
                        </label>
                    </div>
                    @error('payment_method')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Order Notes -->
                <div class="form-section">
                    <h3 class="section-title">Order Notes (Optional)</h3>
                    <div class="form-group">
                        <textarea name="notes" class="form-input form-textarea @error('notes') is-invalid @enderror" 
                                  placeholder="Any special instructions for your order...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h3 class="summary-title">Order Summary</h3>
            
            <!-- Order Items -->
            @foreach($selectedItems as $item)
                <div class="order-item">
                    <div class="item-image">
                        @if($item->product->images && $item->product->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                        @endif
                    </div>
                    <div class="item-details">
                        <div class="item-name">{{ $item->product->name }}</div>
                        <div class="item-options">
                            @if($item->color)
                                <span>Color: {{ $item->color }}</span>
                            @endif
                            @if($item->size)
                                <span>Size: {{ $item->size }}</span>
                            @endif
                        </div>
                        <div class="item-price">
                            <span>Qty: {{ $item->kuantitas }}</span>
                            <span><strong>IDR {{ number_format(($item->product->harga_jual ?? $item->product->harga) * $item->kuantitas, 0, ',', '.') }}</strong></span>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Summary Calculation -->
            <div class="summary-row">
                <span>Subtotal</span>
                <span>IDR {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span>Tax (2.5%)</span>
                <span>IDR {{ number_format($tax, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span>IDR {{ number_format($shipping ?? 15000, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row total">
                <span>Total</span>
                <span>IDR {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <button type="submit" form="checkoutForm" class="place-order-btn" id="placeOrderBtn">
                <span class="btn-text">Place Order</span>
            </button>
        </div>
    </div>
</div>

<script>
    function toggleBillingFields() {
        const checkbox = document.getElementById('same_as_shipping');
        const billingFields = document.getElementById('billing-fields');
        
        if (checkbox.checked) {
            billingFields.style.display = 'none';
            // Clear billing fields
            billingFields.querySelectorAll('input, textarea').forEach(input => {
                input.removeAttribute('required');
            });
        } else {
            billingFields.style.display = 'block';
            // Make billing fields required
            billingFields.querySelectorAll('input[name$="_name"], input[name$="_email"], input[name$="_phone"], textarea[name$="_address"], input[name$="_city"], input[name$="_province"], input[name$="_postal_code"]').forEach(input => {
                input.setAttribute('required', 'required');
            });
        }
    }

    // Payment method selection
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-method').forEach(method => {
                method.classList.remove('selected');
            });
            this.closest('.payment-method').classList.add('selected');
        });
    });

    // Form submission
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('placeOrderBtn');
        const btnText = submitBtn.querySelector('.btn-text');
        
        // Disable button and show loading
        submitBtn.disabled = true;
        btnText.innerHTML = '<span class="spinner"></span>Processing Order...';
        
        // Re-enable button after 15 seconds to prevent permanent lock
        setTimeout(() => {
            if (submitBtn.disabled) {
                submitBtn.disabled = false;
                btnText.textContent = 'Place Order';
            }
        }, 15000);
    });

    // Show notification function
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
            ${type === 'success' ? 'background: #28a745;' : 'background: #dc3545;'}
        `;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => notification.style.transform = 'translateX(0)', 100);
        setTimeout(() => {
            notification.style.transform = 'translateX(400px)';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 4000);
    }

    // Show server-side messages
    @if(session('success'))
        showNotification('success', '{{ session('success') }}');
    @endif

    @if(session('error'))
        showNotification('error', '{{ session('error') }}');
    @endif

    // Initialize billing fields visibility on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleBillingFields();
    });
</script>
@endsection