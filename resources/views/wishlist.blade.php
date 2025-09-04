@extends('layouts.app2')

@section('content')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1a1a1a;
            --secondary-color: #f8f9fa;
            --accent-color: #6366f1;
            --danger-color: #ef4444;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --card-shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        .wishlist-header {
            color: black;
            padding: 40px 0;
            margin-top: 60px;
            position: relative;
            overflow: hidden;
        }

        .wishlist-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='m36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            opacity: 0.1;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .wishlist-title-section {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .wishlist-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            backdrop-filter: blur(10px);
        }

        .wishlist-title {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.025em;
            margin-top: 23px;
        }

        .wishlist-count {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 400;
        }

        .wishlist-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .clear-all-btn {
            background: rgba(253, 5, 5, 0.1);
            border: 1px solid rgba(224, 6, 6, 0.2);
            color: white;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border-radius: 8px;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }

        .clear-all-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: var(--danger-color);
            transform: translateY(-1px);
        }

        .share-wishlist-btn {
            background: linear-gradient(135deg, var(--accent-color) 0%, #8b5cf6 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border-radius: 8px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .share-wishlist-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
        }

        /* Main Content */
        .main-content {
            padding: 40px 0;
        }

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 60px;
        }

        .wishlist-item {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            border: 1px solid var(--border-color);
        }

        .wishlist-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
        }

        .item-image-container {
            position: relative;
            width: 100%;
            height: 280px;
            overflow: hidden;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        }

        .item-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .wishlist-item:hover .item-image-container img {
            transform: scale(1.05);
        }

        .remove-from-wishlist {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            color: var(--danger-color);
            font-size: 16px;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .remove-from-wishlist:hover {
            background: var(--danger-color);
            color: white;
            transform: scale(1.1);
        }

        .out-of-stock-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
            color: white;
            padding: 6px 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            border-radius: 6px;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
        }

        .item-content {
            padding: 24px;
        }

        .item-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
            line-height: 1.4;
            color: var(--text-primary);
        }

        .item-options {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .option-group {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            background: var(--secondary-color);
            border-radius: 6px;
        }

        .option-circle {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #000;
            border: 2px solid white;
            box-shadow: 0 0 0 1px var(--border-color);
            flex-shrink: 0;
        }

        .option-text {
            font-size: 12px;
            color: var(--text-secondary);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .item-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .original-price {
            text-decoration: line-through;
            color: var(--text-secondary);
            font-size: 16px;
            font-weight: 400;
        }

        .discount-badge {
            background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
            color: white;
            padding: 2px 8px;
            font-size: 10px;
            font-weight: 600;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .item-actions {
            display: flex;
            gap: 12px;
        }

        .add-to-cart-btn {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color) 0%, #374151 100%);
            color: white;
            border: none;
            padding: 14px 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 8px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .add-to-cart-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .add-to-cart-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .quick-view-btn {
            background: white;
            border: 2px solid var(--border-color);
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 8px;
            transition: var(--transition);
            color: var(--text-secondary);
            font-size: 16px;
        }

        .quick-view-btn:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
            background: rgba(99, 102, 241, 0.05);
            transform: translateY(-1px);
        }

        /* Empty State */
        .empty-wishlist {
            text-align: center;
            padding: 80px 20px;
            color: var(--text-secondary);
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin: 40px 0;
        }

        .empty-wishlist i {
            font-size: 80px;
            margin-bottom: 24px;
            color: var(--border-color);
        }

        .empty-wishlist h3 {
            font-size: 28px;
            margin-bottom: 12px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .empty-wishlist p {
            font-size: 16px;
            margin-bottom: 32px;
            line-height: 1.6;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .browse-products-btn {
            background: linear-gradient(135deg, var(--accent-color) 0%, #8b5cf6 100%);
            color: white;
            border: none;
            padding: 16px 32px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 8px;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .browse-products-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
        }

        /* Recently Viewed */
        .recently-viewed {
            margin-top: 60px;
            padding-top: 40px;
            border-top: 2px solid var(--border-color);
        }

        .recently-viewed h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 32px;
            color: var(--text-primary);
            position: relative;
            padding-left: 16px;
        }

        .recently-viewed h3::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background: linear-gradient(135deg, var(--accent-color) 0%, #8b5cf6 100%);
            border-radius: 2px;
        }

        .recently-viewed-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .recently-viewed-item {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            cursor: pointer;
            border: 1px solid var(--border-color);
        }

        .recently-viewed-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover);
        }

        .recently-viewed-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        }

        .recently-viewed-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .recently-viewed-item:hover .recently-viewed-image img {
            transform: scale(1.05);
        }

        .recently-viewed-content {
            padding: 20px;
        }

        .recently-viewed-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .recently-viewed-price {
            font-size: 16px;
            font-weight: 700;
            color: var(--accent-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .wishlist-header {
                padding: 30px 0;
            }

            .header-content {
                flex-direction: column;
                gap: 24px;
                text-align: center;
            }

            .wishlist-actions {
                width: 100%;
                justify-content: center;
            }

            .wishlist-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 20px;
            }

            .recently-viewed-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }

            .wishlist-title {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 16px;
            }

            .wishlist-grid {
                grid-template-columns: 1fr;
            }

            .wishlist-actions {
                flex-direction: column;
                width: 100%;
                gap: 8px;
            }

            .clear-all-btn,
            .share-wishlist-btn {
                width: 100%;
                padding: 14px 20px;
            }

            .recently-viewed-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .item-content {
                padding: 20px;
            }

            .wishlist-title {
                font-size: 24px;
            }
        }

        /* Loading Animation */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .pulse {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Success Animation */
        .success-animation {
            animation: successPulse 0.6s ease-in-out;
        }

        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>

    <!-- Header Section -->
    <div class="wishlist-header">
        <div class="container">
            <div class="header-content">
                <div class="wishlist-title-section">
                    <div class="wishlist-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div>
                        <h1 class="wishlist-title">My Wishlist</h1>
                        <span class="wishlist-count">4 Items</span>
                    </div>
                </div>
                <div class="wishlist-actions">
                    <button class="clear-all-btn" onclick="clearWishlist()">
                        <i class="fas fa-trash-alt"></i> Clear All
                    </button>
                    <button class="share-wishlist-btn" onclick="shareWishlist()">
                        <i class="fas fa-share"></i> Share Wishlist
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="wishlist-grid" id="wishlistGrid">
                <!-- Shadowtech Eclipse Sneakers -->
                <div class="wishlist-item">
                    <div class="item-image-container">
                        <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&h=300&fit=crop&crop=center" alt="Shadowtech Eclipse Sneakers">
                        <button class="remove-from-wishlist" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="item-content">
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
                        <div class="item-price">$120.53</div>
                        <div class="item-actions">
                            <button class="add-to-cart-btn" onclick="addToCart(this)">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="quick-view-btn" onclick="quickView(this)" title="Quick view">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Neonoir Vanguard Boots -->
                <div class="wishlist-item">
                    <div class="item-image-container">
                        <img src="https://images.unsplash.com/photo-1544966503-7cc5ac882d5e?w=400&h=300&fit=crop&crop=center" alt="Neonoir Vanguard Boots">
                        <button class="remove-from-wishlist" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="item-content">
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
                        <div class="item-price">
                            <span class="original-price">$245.20</span>
                            $210.14
                            <span class="discount-badge">-14%</span>
                        </div>
                        <div class="item-actions">
                            <button class="add-to-cart-btn" onclick="addToCart(this)">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="quick-view-btn" onclick="quickView(this)" title="Quick view">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Cybergoth Stealth Kicks -->
                <div class="wishlist-item">
                    <div class="item-image-container">
                        <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=400&h=300&fit=crop&crop=center" alt="Cybergoth Stealth Kicks">
                        <button class="remove-from-wishlist" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                        <div class="out-of-stock-badge">Out of Stock</div>
                    </div>
                    <div class="item-content">
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
                        <div class="item-price">$154.32</div>
                        <div class="item-actions">
                            <button class="add-to-cart-btn" disabled>
                                <i class="fas fa-times"></i> Out of Stock
                            </button>
                            <button class="quick-view-btn" onclick="quickView(this)" title="Quick view">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Urban Phantom Runners -->
                <div class="wishlist-item">
                    <div class="item-image-container">
                        <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=400&h=300&fit=crop&crop=center" alt="Urban Phantom Runners">
                        <button class="remove-from-wishlist" onclick="removeFromWishlist(this)" title="Remove from wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="item-content">
                        <h3 class="item-name">Urban Phantom Runners</h3>
                        <div class="item-options">
                            <div class="option-group">
                                <div class="option-circle" style="background-color: #666;"></div>
                                <span class="option-text">Grey</span>
                            </div>
                            <div class="option-group">
                                <span class="option-text">US 8</span>
                            </div>
                        </div>
                        <div class="item-price">$89.99</div>
                        <div class="item-actions">
                            <button class="add-to-cart-btn" onclick="addToCart(this)">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="quick-view-btn" onclick="quickView(this)" title="Quick view">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recently Viewed Section -->
            <div class="recently-viewed">
                <h3><i class="fas fa-history"></i> Recently Viewed</h3>
                <div class="recently-viewed-grid">
                    <div class="recently-viewed-item" onclick="viewProduct(this)">
                        <div class="recently-viewed-image">
                            <img src="https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=300&h=200&fit=crop&crop=center" alt="Recently viewed item">
                        </div>
                        <div class="recently-viewed-content">
                            <div class="recently-viewed-name">Dark Matter Sneakers</div>
                            <div class="recently-viewed-price">$99.99</div>
                        </div>
                    </div>

                    <div class="recently-viewed-item" onclick="viewProduct(this)">
                        <div class="recently-viewed-image">
                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&h=200&fit=crop&crop=center" alt="Recently viewed item">
                        </div>
                        <div class="recently-viewed-content">
                            <div class="recently-viewed-name">Retro Wave Runners</div>
                            <div class="recently-viewed-price">$134.50</div>
                        </div>
                    </div>

                    <div class="recently-viewed-item" onclick="viewProduct(this)">
                        <div class="recently-viewed-image">
                            <img src="https://images.unsplash.com/photo-1551107696-a4b0c5a0d9a2?w=300&h=200&fit=crop&crop=center" alt="Recently viewed item">
                        </div>
                        <div class="recently-viewed-content">
                            <div class="recently-viewed-name">Minimalist Whites</div>
                            <div class="recently-viewed-price">$79.99</div>
                        </div>
                    </div>

                    <div class="recently-viewed-item" onclick="viewProduct(this)">
                        <div class="recently-viewed-image">
                            <img src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=300&h=200&fit=crop&crop=center" alt="Recently viewed item">
                        </div>
                        <div class="recently-viewed-content">
                            <div class="recently-viewed-name">Street Combat Boots</div>
                            <div class="recently-viewed-price">$189.99</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function removeFromWishlist(btn) {
            const item = btn.closest('.wishlist-item');
            item.style.transform = 'scale(0.8)';
            item.style.opacity = '0';

            setTimeout(() => {
                item.remove();
                updateWishlistCount();
                checkEmptyWishlist();
            }, 300);
        }

        function addToCart(btn) {
            const item = btn.closest('.wishlist-item');
            const itemName = item.querySelector('.item-name').textContent;

            // Add loading state
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            btn.disabled = true;
            btn.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';

            // Add success animation to item
            item.classList.add('success-animation');

            // Reset button after 2 seconds
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check"></i> Added!';

                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
                    btn.style.background = 'linear-gradient(135deg, var(--primary-color) 0%, #374151 100%)';
                    btn.disabled = false;
                    item.classList.remove('success-animation');
                }, 1500);
            }, 1000);

            console.log(`Added ${itemName} to cart`);
        }

        function quickView(btn) {
            const item = btn.closest('.wishlist-item');
            const itemName = item.querySelector('.item-name').textContent;

            // Create modal effect (simplified)
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 1000;
                backdrop-filter: blur(10px);
            `;

            const modalContent = document.createElement('div');
            modalContent.style.cssText = `
                background: white;
                padding: 40px;
                border-radius: 16px;
                text-align: center;
                max-width: 400px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            `;

            modalContent.innerHTML = `
                <i class="fas fa-eye" style="font-size: 48px; color: var(--accent-color); margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 16px; color: var(--text-primary);">Quick View</h3>
                <p style="color: var(--text-secondary); margin-bottom: 24px;">${itemName}</p>
                <button onclick="this.parentElement.parentElement.remove()"
                        style="background: var(--accent-color); color: white; border: none;
                               padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    Close
                </button>
            `;

            modal.appendChild(modalContent);
            document.body.appendChild(modal);

            // Close on backdrop click
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        }

        function clearWishlist() {
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 1000;
                backdrop-filter: blur(10px);
            `;

            const modalContent = document.createElement('div');
            modalContent.style.cssText = `
                background: white;
                padding: 40px;
                border-radius: 16px;
                text-align: center;
                max-width: 400px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            `;

            modalContent.innerHTML = `
                <i class="fas fa-exclamation-triangle" style="font-size: 48px; color: var(--warning-color); margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 16px; color: var(--text-primary);">Clear Wishlist</h3>
                <p style="color: var(--text-secondary); margin-bottom: 24px;">Are you sure you want to remove all items from your wishlist?</p>
                <div style="display: flex; gap: 12px; justify-content: center;">
                    <button onclick="this.parentElement.parentElement.parentElement.remove()"
                            style="background: #e5e7eb; color: var(--text-secondary); border: none;
                                   padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                        Cancel
                    </button>
                    <button onclick="confirmClearWishlist()"
                            style="background: var(--danger-color); color: white; border: none;
                                   padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                        Clear All
                    </button>
                </div>
            `;

            modal.appendChild(modalContent);
            document.body.appendChild(modal);

            window.confirmClearWishlist = function() {
                modal.remove();
                const items = document.querySelectorAll('.wishlist-item');
                items.forEach((item, index) => {
                    setTimeout(() => {
                        item.style.transform = 'scale(0.8)';
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.remove();
                            if (index === items.length - 1) {
                                updateWishlistCount();
                                checkEmptyWishlist();
                            }
                        }, 300);
                    }, index * 100);
                });
            };
        }

        function shareWishlist() {
            if (navigator.share) {
                navigator.share({
                    title: 'My Wishlist',
                    text: 'Check out my wishlist!',
                    url: window.location.href
                });
            } else {
                // Enhanced fallback with better UX
                navigator.clipboard.writeText(window.location.href).then(() => {
                    const btn = event.target;
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<i class="fas fa-check"></i> Link Copied!';
                    btn.style.background = 'linear-gradient(135deg, var(--success-color) 0%, #059669 100%)';

                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.style.background = 'linear-gradient(135deg, var(--accent-color) 0%, #8b5cf6 100%)';
                    }, 2000);
                });
            }
        }

        function updateWishlistCount() {
            const count = document.querySelectorAll('.wishlist-item').length;
            document.querySelector('.wishlist-count').textContent = `${count} Items`;
        }

        function checkEmptyWishlist() {
            const wishlistGrid = document.getElementById('wishlistGrid');
            const items = document.querySelectorAll('.wishlist-item');

            if (items.length === 0) {
                wishlistGrid.innerHTML = `
                    <div class="empty-wishlist" style="grid-column: 1 / -1;">
                        <i class="fas fa-heart-broken"></i>
                        <h3>Your wishlist is empty</h3>
                        <p>Discover amazing products and save your favorites here. Start building your perfect collection today!</p>
                        <a href="#" class="browse-products-btn">
                            <i class="fas fa-shopping-bag"></i> Browse Products
                        </a>
                    </div>
                `;
            }
        }

        function viewProduct(item) {
            const productName = item.querySelector('.recently-viewed-name').textContent;
            const productPrice = item.querySelector('.recently-viewed-price').textContent;

            // Add click animation
            item.style.transform = 'scale(0.98)';
            setTimeout(() => {
                item.style.transform = 'translateY(-2px)';
            }, 100);

            console.log(`Viewing product: ${productName} - ${productPrice}`);
        }

        // Enhanced hover effects for recently viewed items
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.recently-viewed-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px) scale(1.02)';
                    this.style.boxShadow = 'var(--card-shadow-hover)';
                });

                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = 'var(--card-shadow)';
                });
            });

            // Add loading animation on page load
            const items = document.querySelectorAll('.wishlist-item');
            items.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    item.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Add smooth scrolling behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Enhanced keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close any open modals
                const modals = document.querySelectorAll('div[style*="position: fixed"]');
                modals.forEach(modal => modal.remove());
            }
        });
    </script>

@endsection
