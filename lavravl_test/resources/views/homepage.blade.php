<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - {{ config('app.name', 'Laravel') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid #e5e5e5;
        }
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: inherit;
        }
        .logo-container {
            position: relative;
            width: 70px;
            height: 70px;
            flex-shrink: 0;
        }
        .logo-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: white;
            border: 2px solid #d4af37;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .logo:hover .logo-circle {
            transform: scale(1.05);
            box-shadow: 0 6px 25px rgba(212, 175, 55, 0.5), 
                        inset 0 2px 10px rgba(212, 175, 55, 0.15);
        }
        .logo-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
            padding: 5px;
        }
        .logo-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 1rem;
        }
        .logo-main-text {
            font-size: 1.2rem;
            font-weight: 800;
            color: #2c3e50;
            letter-spacing: 1.5px;
            line-height: 1.1;
            text-shadow: none;
            text-transform: uppercase;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .logo-sub-text {
            font-size: 0.65rem;
            color: #666;
            font-weight: 600;
            letter-spacing: 2px;
            margin-top: 0.1rem;
            text-transform: uppercase;
        }
        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        .nav-links li {
            margin: 0;
        }
        .nav-links a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            transition: color 0.3s;
            position: relative;
        }
        .nav-links a:hover {
            color: #667eea;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #667eea;
            transition: width 0.3s;
        }
        .nav-links a:hover::after {
            width: 100%;
        }
        .auth-buttons {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        .search-bar {
            display: flex;
            align-items: center;
            position: relative;
        }
        .search-input {
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 0.85rem;
            width: 200px;
            transition: all 0.3s;
        }
        .search-input:focus {
            outline: none;
            border-color: #667eea;
            width: 250px;
        }
        .search-icon {
            position: absolute;
            left: 0.75rem;
            color: #999;
            width: 18px;
            height: 18px;
            pointer-events: none;
        }
        .header-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 50%;
            transition: background-color 0.3s;
            position: relative;
        }
        .header-icon:hover {
            background-color: #f5f5f5;
        }
        .header-icon svg {
            width: 22px;
            height: 22px;
            fill: #2c3e50;
        }
        .cart-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #4caf50;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .user-name {
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: capitalize;
        }
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active {
            display: flex;
        }
        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            padding: 0;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            animation: slideDown 0.3s ease;
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid #e5e5e5;
        }
        .modal-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #999;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.3s;
        }
        .modal-close:hover {
            background-color: #f5f5f5;
        }
        .modal-body {
            padding: 1.5rem;
        }
        .modal-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 1rem;
            transition: border-color 0.3s;
        }
        .modal-input:focus {
            outline: none;
            border-color: #667eea;
        }
        .modal-button {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .modal-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
        .modal-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e5e5e5;
        }
        .modal-tab {
            padding: 0.5rem 0;
            background: none;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            color: #999;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: color 0.3s;
        }
        .modal-tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }
        .modal-tab:hover {
            color: #667eea;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .btn-login, .btn-register {
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
            border: 2px solid transparent;
            white-space: nowrap;
        }
        .btn-login {
            background: transparent;
            color: #667eea;
            border-color: #667eea;
        }
        .btn-login:hover {
            background: #667eea;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .user-name {
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: capitalize;
            margin-right: 0.5rem;
        }
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #ff6b6b 0%, #ffa500 50%, #ffd700 100%);
            padding: 4rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 200"><path d="M0,100 Q300,50 600,100 T1200,100 L1200,200 L0,200 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.3;
        }
        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }
        .hero-features {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }
        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            backdrop-filter: blur(10px);
        }
        .feature-text {
            font-size: 0.9rem;
            font-weight: 500;
        }
        .btn-shop {
            background: white;
            color: #ff6b6b;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            display: inline-block;
            margin-top: 1rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-shop:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        /* Products Section */
        .products-section {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 1rem;
        }
        .section-subtitle {
            text-align: center;
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .product-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }
        .product-info {
            padding: 1.5rem;
        }
        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }
        .product-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 1rem;
        }
        .btn-add-cart {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .btn-add-cart:hover {
            transform: scale(1.02);
        }
        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 3rem 2rem;
            margin-top: 4rem;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }
            .nav-links {
                flex-direction: column;
                gap: 1rem;
            }
            .hero h1 {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1.2rem;
            }
            .hero-features {
                gap: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header Navigation -->
    <header class="header">
        <div class="nav-container">
            <a href="/" class="logo">
                <div class="logo-container">
                    <div class="logo-circle">
                        @if(file_exists(public_path('images/monkey.png')))
                            <img src="{{ asset('images/monkey.png') }}" alt="Himalayan Basket Logo" class="logo-image">
                        @elseif(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="Himalayan Basket Logo" class="logo-image">
                        @elseif(file_exists(public_path('images/logo.jpg')))
                            <img src="{{ asset('images/logo.jpg') }}" alt="Himalayan Basket Logo" class="logo-image">
                        @else
                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#d4af37; font-weight:bold; font-size:2rem;">HB</div>
                        @endif
                    </div>
                </div>
                <div class="logo-text">
                    <div class="logo-main-text">HIMALAYAN Basket</div>
                    <div class="logo-sub-text">NATURAL PRODUCTS</div>
                </div>
            </a>
            <nav>
                <ul class="nav-links">
                    <li><a href="/">HOME</a></li>
                    <li><a href="#products">SHOP</a></li>
                    <li><a href="/about">ABOUT US</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <div class="search-bar">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" class="search-input" placeholder="Search products...">
                </div>
                @auth
                    <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                    <div class="user-menu">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <div class="header-icon" onclick="showUserMenu()" title="{{ Auth::user()->name }}">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <div class="header-icon" onclick="showCart()">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                            </svg>
                            <span class="cart-badge">0</span>
                        </div>
                    </div>
                @else
                    <div class="header-icon" onclick="openAuthModal()">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <div class="header-icon" onclick="showCart()">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                        <span class="cart-badge">0</span>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div style="font-size: 1rem; margin-bottom: 0.5rem; opacity: 0.9;">Traditionally</div>
            <h1>Hand Churned</h1>
            <div style="font-size: 1.5rem; margin-bottom: 2rem;">A2 Gir Cow Bilona Ghee</div>
            
            <div class="hero-features">
                <div class="feature-item">
                    <div class="feature-icon">❤️</div>
                    <div class="feature-text">Highly Nutritious</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🔄</div>
                    <div class="feature-text">Made using the Bilona Process</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🐄</div>
                    <div class="feature-text">Made from Milk of Desi Cows</div>
                </div>
            </div>
            
            <a href="#products" class="btn-shop">Shop Now</a>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section" id="products">
        <h2 class="section-title">Our Range</h2>
        <p class="section-subtitle">All Natural Grocery Products Just for You</p>
        
        <div class="products-grid">
            <div class="product-card">
                <div class="product-image">🥛</div>
                <div class="product-info">
                    <div class="product-name">A2 Gir Cow Bilona Ghee</div>
                    <div class="product-description">Traditionally hand-churned ghee made from A2 milk of Gir cows</div>
                    <div class="product-price">$24.99</div>
                    <button class="btn-add-cart">Add to Cart</button>
                </div>
            </div>
            
            <div class="product-card">
                <div class="product-image">🍯</div>
                <div class="product-info">
                    <div class="product-name">Raw Honey</div>
                    <div class="product-description">Pure, unprocessed honey from Himalayan bees</div>
                    <div class="product-price">$18.99</div>
                    <button class="btn-add-cart">Add to Cart</button>
                </div>
            </div>
            
            <div class="product-card">
                <div class="product-image">🌾</div>
                <div class="product-info">
                    <div class="product-name">Organic Quinoa</div>
                    <div class="product-description">Premium quality organic quinoa grains</div>
                    <div class="product-price">$12.99</div>
                    <button class="btn-add-cart">Add to Cart</button>
                </div>
            </div>
            
            <div class="product-card">
                <div class="product-image">🥜</div>
                <div class="product-info">
                    <div class="product-name">Almonds</div>
                    <div class="product-description">Premium California almonds, raw and organic</div>
                    <div class="product-price">$15.99</div>
                    <button class="btn-add-cart">Add to Cart</button>
                </div>
            </div>
            
            <div class="product-card">
                <div class="product-image">🌿</div>
                <div class="product-info">
                    <div class="product-name">Turmeric Powder</div>
                    <div class="product-description">Pure organic turmeric powder, ground fresh</div>
                    <div class="product-price">$9.99</div>
                    <button class="btn-add-cart">Add to Cart</button>
                </div>
            </div>
            
            <div class="product-card">
                <div class="product-image">🌰</div>
                <div class="product-info">
                    <div class="product-name">Cashews</div>
                    <div class="product-description">Premium whole cashews, raw and unsalted</div>
                    <div class="product-price">$19.99</div>
                    <button class="btn-add-cart">Add to Cart</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-content">
            <h3>HIMALAYAN Basket</h3>
            <p style="margin-top: 1rem; opacity: 0.8;">100% Natural Grocery Products</p>
            <p style="margin-top: 1rem; opacity: 0.8;">Contact us: info@himalayanbasket.com</p>
            <p style="margin-top: 2rem; opacity: 0.6;">&copy; 2025 Himalayan Basket. All rights reserved.</p>
        </div>
    </footer>

    <!-- Login/Register Modal -->
    <div class="modal-overlay" id="authModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <svg viewBox="0 0 24 24" fill="currentColor" style="width: 24px; height: 24px;">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    Sign In/Sign Up
                </div>
                <button class="modal-close" onclick="closeAuthModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-tabs">
                    <button class="modal-tab active" onclick="switchTab('login')">Login</button>
                    <button class="modal-tab" onclick="switchTab('register')">Register</button>
                </div>
                
                <!-- Login Form -->
                <div id="loginTab" class="tab-content active">
                    @if($errors->any() && old('_token') && !old('name'))
                        <div style="background: #fee; color: #c33; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; font-size: 0.9rem;">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        <input type="email" name="email" class="modal-input" placeholder="Email Address *" value="{{ old('email') }}" required>
                        <input type="password" name="password" class="modal-input" placeholder="Password *" required>
                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                            <input type="checkbox" id="remember" name="remember" style="margin-right: 0.5rem;">
                            <label for="remember" style="font-size: 0.9rem; color: #666;">Remember me</label>
                        </div>
                        <button type="submit" class="modal-button">Login</button>
                    </form>
                </div>
                
                <!-- Register Form -->
                <div id="registerTab" class="tab-content">
                    @if($errors->any() && old('name'))
                        <div style="background: #fee; color: #c33; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; font-size: 0.9rem;">
                            <ul style="margin: 0; padding-left: 1.25rem;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf
                        <input type="text" name="name" class="modal-input" placeholder="Full Name *" value="{{ old('name') }}" required>
                        <input type="email" name="email" class="modal-input" placeholder="Email Address *" value="{{ old('email') }}" required>
                        <input type="password" name="password" class="modal-input" placeholder="Password *" required>
                        <input type="password" name="password_confirmation" class="modal-input" placeholder="Confirm Password *" required>
                        <button type="submit" class="modal-button">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAuthModal() {
            document.getElementById('authModal').classList.add('active');
        }
        
        function closeAuthModal() {
            document.getElementById('authModal').classList.remove('active');
        }
        
        function switchTab(tab) {
            // Update tabs
            document.querySelectorAll('.modal-tab').forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');
            
            // Update content
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.getElementById(tab + 'Tab').classList.add('active');
        }
        
        function showCart() {
            alert('Cart functionality coming soon!');
        }
        
        function showUserMenu() {
            // Show logout option or user menu dropdown
            if (confirm('Do you want to logout?')) {
                document.getElementById('logoutForm').submit();
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('authModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAuthModal();
            }
        });
        
        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAuthModal();
            }
        });
    </script>
</body>
</html>

