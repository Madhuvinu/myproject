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
                    <li><a href="/" onclick="showSection('home'); return false;">HOME</a></li>
                    <li><a href="#products" onclick="showSection('products'); return false;">SHOP</a></li>
                    <li><a href="#about-us" onclick="showSection('about-us'); return false;">ABOUT US</a></li>
                    <li><a href="#contact" onclick="showSection('contact'); return false;">CONTACT</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <div class="search-bar">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" class="search-input" id="productSearch" placeholder="Search products..." onkeyup="searchProducts(this.value)">
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
        <div class="hero-slider">
            <div class="slide active">
                <img src="{{ asset('images/Himalayan_Basket_Lorry_Ad.png') }}" alt="Himalayan Basket Lorry Ad" class="hero-image lorry-image">
                <!-- Smoke effect near tires -->
                <div class="smoke smoke-1"></div>
                <div class="smoke smoke-2"></div>
                <div class="smoke smoke-3"></div>
                <!-- Wheel rotation on existing wheels -->
                <div class="wheel-rotate wheel-1"></div>
                <div class="wheel-rotate wheel-2"></div>
                <div class="wheel-rotate wheel-3"></div>
            </div>
            <div class="slide">
                <img src="{{ asset('images/useme copy.png') }}" alt="Himalayan Basket Banner" class="hero-image useme-image">
                <!-- Pop-up text appearing one by one -->
                <div class="useme-popup-text">
                    <div class="popup-content">
                        <!-- Cloud templates inside -->
                        <div class="cloud cloud-1"></div>
                        <div class="cloud cloud-2"></div>
                        <div class="cloud cloud-3"></div>
                        <div class="cloud cloud-4"></div>
                        <span class="popup-text-line popup-line-1">Chew bars</span>
                        <span class="popup-text-line popup-line-2">from Pure Cow</span>
                        <span class="popup-text-line popup-line-3">- Himalayan Bars</span>
                    </div>
                </div>
            </div>
            <!-- Add more slides here if needed -->
        </div>
        
        
        <!-- Slider Dots -->
        <div class="slider-dots" id="sliderDots"></div>
        
    </section>

    <!-- Products Section -->
    <section class="products-section" id="products">
        <div class="shop-now-container">
            <a href="#products" class="shop-now-btn">
                <span>Shop Now</span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        <h2 class="section-title">Our Range</h2>
        <p class="section-subtitle">All Natural Grocery Products Just for You</p>
        
        <div class="products-grid" id="productsGrid">
            @forelse($products as $product)
                <div class="product-card" data-product-name="{{ strtolower($product->name) }}" data-product-description="{{ strtolower($product->description ?? '') }}">
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
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="product-cart-form">
                                @csrf
                                <div class="quantity-selector">
                                    <label for="quantity-{{ $product->id }}" class="quantity-label">Quantity:</label>
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn quantity-decrease" onclick="decreaseQuantity({{ $product->id }})">-</button>
                                        <input type="number" id="quantity-{{ $product->id }}" name="quantity" value="1" min="1" max="99" class="quantity-input" readonly>
                                        <button type="button" class="quantity-btn quantity-increase" onclick="increaseQuantity({{ $product->id }})">+</button>
                                    </div>
                                </div>
                                <button type="submit" class="btn-add-cart">Add to Cart</button>
                            </form>
                        @else
                            <div class="quantity-selector">
                                <label class="quantity-label">Quantity:</label>
                                <div class="quantity-controls">
                                    <button type="button" class="quantity-btn quantity-decrease" onclick="openAuthModal()">-</button>
                                    <input type="number" value="1" min="1" max="99" class="quantity-input" readonly>
                                    <button type="button" class="quantity-btn quantity-increase" onclick="openAuthModal()">+</button>
                                </div>
                            </div>
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
        
        <div id="noResults" style="display: none; grid-column: 1 / -1; text-align: center; padding: 3rem; color: #666;">
            <p style="font-size: 1.2rem; margin-bottom: 1rem;">No products found matching your search.</p>
            <p>Try a different search term.</p>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us-section" id="about-us" style="display: none;">
        <div class="about-us-container">
            @if($aboutUs)
                @if($aboutUs->title)
                    <h2 class="section-title">{{ $aboutUs->title }}</h2>
                @else
                    <h2 class="section-title">About Us</h2>
                @endif
                
                @if($aboutUs->content)
                    <div class="about-content">
                        <p>{{ $aboutUs->content }}</p>
                    </div>
                @endif
                
                @if($aboutUs->images->count() > 0)
                    <div class="about-images">
                        @foreach($aboutUs->images as $image)
                            <div class="about-image-item">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="About Us Image">
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <div class="about-details">
                    @if($aboutUs->mission)
                        <div class="about-detail-card">
                            <h3>Our Mission</h3>
                            <p>{{ $aboutUs->mission }}</p>
                        </div>
                    @endif
                    
                    @if($aboutUs->vision)
                        <div class="about-detail-card">
                            <h3>Our Vision</h3>
                            <p>{{ $aboutUs->vision }}</p>
                        </div>
                    @endif
                    
                    @if($aboutUs->values)
                        <div class="about-detail-card">
                            <h3>Our Values</h3>
                            <p>{{ $aboutUs->values }}</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="about-us-empty">
                    <h2 class="section-title">About Us</h2>
                    <p>Content coming soon...</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-content">
            <div class="footer-brand">
                <h3>HIMALAYAN Basket</h3>
                <p class="footer-tagline">100% Natural Grocery Products</p>
            </div>
            
            <div class="footer-features">
                <div class="footer-feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <p>100% Natural ingredients</p>
                </div>
                <div class="footer-feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                        </svg>
                    </div>
                    <p>GMO Free</p>
                </div>
                <div class="footer-feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <p>Ethically & Sustainably sourced</p>
                </div>
                <div class="footer-feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                        </svg>
                    </div>
                    <p>Preservative Free</p>
                </div>
                <div class="footer-feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <p>Unprocessed Products</p>
                </div>
            </div>
            
            <div class="footer-contact">
                <div class="contact-item">
                    <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <div>
                        <p class="contact-label">Location</p>
                        <p class="contact-value">Champawat, Uttarakhand 262523, India</p>
                    </div>
                </div>
                <div class="contact-item">
                    <svg class="contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <div>
                        <p class="contact-label">Email</p>
                        <p class="contact-value">info@himalayanbasket.com</p>
                    </div>
                </div>
            </div>
            
            <div class="footer-copyright">
                <p>&copy; 2025 Himalayan Basket. All rights reserved.</p>
            </div>
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
        // Show/hide sections functionality
        function showSection(sectionName) {
            // Hide all main sections
            const hero = document.querySelector('.hero');
            const productsSection = document.querySelector('.products-section');
            const aboutUsSection = document.querySelector('.about-us-section');
            
            if (hero) hero.style.display = 'none';
            if (productsSection) productsSection.style.display = 'none';
            if (aboutUsSection) aboutUsSection.style.display = 'none';
            
            // Show selected section
            if (sectionName === 'home') {
                if (hero) hero.style.display = 'flex';
                if (productsSection) productsSection.style.display = 'block';
            } else if (sectionName === 'products') {
                if (hero) hero.style.display = 'flex';
                if (productsSection) productsSection.style.display = 'block';
                // Scroll to products
                setTimeout(() => {
                    document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
                }, 100);
            } else if (sectionName === 'about-us') {
                if (aboutUsSection) {
                    aboutUsSection.style.display = 'block';
                    // Scroll to about us
                    setTimeout(() => {
                        document.getElementById('about-us').scrollIntoView({ behavior: 'smooth' });
                    }, 100);
                }
            }
        }
        
        // Handle hash navigation on page load
        window.addEventListener('load', function() {
            const hash = window.location.hash;
            if (hash === '#about-us') {
                showSection('about-us');
            } else if (hash === '#products') {
                showSection('products');
            }
        });
        
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
        
        // Search functionality - Client-side filtering for instant results
        function searchProducts(searchTerm) {
            const searchLower = searchTerm.toLowerCase().trim();
            const productCards = document.querySelectorAll('.product-card');
            const noResults = document.getElementById('noResults');
            let visibleCount = 0;
            
            productCards.forEach(card => {
                const productName = card.getAttribute('data-product-name') || '';
                const productDescription = card.getAttribute('data-product-description') || '';
                
                if (searchTerm === '' || 
                    productName.includes(searchLower) || 
                    productDescription.includes(searchLower)) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show/hide "no results" message
            if (searchTerm !== '' && visibleCount === 0) {
                noResults.style.display = 'block';
            } else {
                noResults.style.display = 'none';
            }
        }
        
        // Server-side search on Enter key (for more comprehensive search)
        document.getElementById('productSearch').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const searchTerm = this.value.trim();
                if (searchTerm) {
                    window.location.href = '/?search=' + encodeURIComponent(searchTerm) + '#products';
                } else {
                    window.location.href = '/#products';
                }
            }
        });
        
        // Quantity control functions
        function increaseQuantity(productId) {
            const input = document.getElementById('quantity-' + productId);
            const currentValue = parseInt(input.value) || 1;
            if (currentValue < 99) {
                input.value = currentValue + 1;
            }
        }
        
        function decreaseQuantity(productId) {
            const input = document.getElementById('quantity-' + productId);
            const currentValue = parseInt(input.value) || 1;
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
        
        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dotsContainer = document.getElementById('sliderDots');
        let autoSlide;
        
        // Create dots
        function createDots() {
            if (slides.length > 1 && dotsContainer) {
                dotsContainer.innerHTML = ''; // Clear existing dots
                slides.forEach((_, index) => {
                    const dot = document.createElement('div');
                    dot.className = 'dot' + (index === currentSlide ? ' active' : '');
                    dot.onclick = () => goToSlide(index);
                    dotsContainer.appendChild(dot);
                });
            }
        }
        
        // Update slides
        function updateSlides() {
            const wasActive = slides[currentSlide]?.classList.contains('active');
            
            slides.forEach((slide, index) => {
                slide.classList.toggle('active', index === currentSlide);
                
                // Reset wheel animations when lorry slide becomes active
                if (index === currentSlide && !wasActive && slide.querySelector('.lorry-image')) {
                    const wheelRotates = slide.querySelectorAll('.wheel-rotate');
                    wheelRotates.forEach(wheel => {
                        wheel.style.animation = 'none';
                        void wheel.offsetWidth; // Trigger reflow
                        wheel.style.animation = 'wheelRotateBeforeChange 2s linear 1';
                        wheel.style.animationDelay = '5s';
                        wheel.style.animationFillMode = 'forwards';
                    });
                }
            });
            
            const dots = document.querySelectorAll('.dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
            
            // Restart auto-play when slide changes - this ensures proper timing
            if (autoSlide) {
                clearInterval(autoSlide);
                clearTimeout(autoSlide);
            }
            startAutoPlay();
        }
        
        // Change slide
        function changeSlide(direction) {
            if (slides.length <= 1) return;
            currentSlide += direction;
            if (currentSlide < 0) {
                currentSlide = slides.length - 1;
            } else if (currentSlide >= slides.length) {
                currentSlide = 0;
            }
            updateSlides();
        }
        
        // Go to specific slide
        function goToSlide(index) {
            if (slides.length <= 1) return;
            currentSlide = index;
            updateSlides();
        }
        
        // Start auto-play
        function startAutoPlay() {
            // Clear any existing timers
            if (autoSlide) {
                clearInterval(autoSlide);
                clearTimeout(autoSlide);
            }
            
            // Check if current slide is the lorry slide (first slide with wheels)
            const currentSlideElement = slides[currentSlide];
            const isLorrySlide = currentSlideElement && currentSlideElement.querySelector('.lorry-image');
            
            if (isLorrySlide) {
                // For lorry slide: wait 7 seconds total (5s still + 2s rotation) before changing
                // Wheel animation: delay 5s, duration 2s, so change happens at 7s
                autoSlide = setTimeout(() => {
                    changeSlide(1);
                }, 7000);
            } else {
                // For other slides: use normal interval
                autoSlide = setInterval(() => {
                    changeSlide(1);
                }, 7000);
            }
        }
        
        // Pause auto-play on hover
        const heroSlider = document.querySelector('.hero-slider');
        if (heroSlider) {
            heroSlider.addEventListener('mouseenter', () => {
                if (autoSlide) {
                    clearInterval(autoSlide);
                    clearTimeout(autoSlide);
                }
            });
            
            heroSlider.addEventListener('mouseleave', () => {
                startAutoPlay();
            });
        }
        
        // Start auto-play initially
        startAutoPlay();
        
        // Initialize dots when page loads
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', createDots);
        } else {
            createDots();
        }
    </script>
</body>
</html>

