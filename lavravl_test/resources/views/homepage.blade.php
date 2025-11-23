<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/homepage.css'])
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
                            <span class="cart-badge">{{ Auth::user()->cartItems->sum('quantity') }}</span>
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
                            <span class="cart-badge">{{ $cartCount ?? 0 }}</span>
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
            @forelse($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                        @else
                            <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; font-size: 3rem; border-radius: 8px;">📦</div>
                        @endif
                    </div>
                    <div class="product-info">
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-description">{{ $product->description ?? 'Premium quality product' }}</div>
                        <div class="product-price">${{ number_format($product->price, 2) }}</div>
                        @auth
                            <form action="{{ route('cart.add', $product) }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn-add-cart">Add to Cart</button>
                            </form>
                        @else
                            <button class="btn-add-cart" onclick="openAuthModal()">Add to Cart</button>
                        @endauth
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #666;">
                    <p style="font-size: 1.2rem; margin-bottom: 1rem;">No products available yet.</p>
                    <p>Check back soon for our amazing products!</p>
                </div>
            @endforelse
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
            @auth
                window.location.href = '{{ route("cart.index") }}';
            @else
                openAuthModal();
            @endauth
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

