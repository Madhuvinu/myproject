# Technologies Used in This Project

## 🎯 Core Technologies

### **Backend (Server-Side)**
1. **PHP 8.4.15** - Main server-side programming language
2. **Laravel 12.0** - PHP web framework (MVC architecture)
3. **MySQL** - Database management system
   - Database: `mydb`
   - Host: `127.0.0.1:3306`
   - Connection with SSL disabled, public key retrieval enabled

### **Frontend (Client-Side)**
1. **HTML5** - Markup language for structure
2. **CSS3** - Styling language
3. **JavaScript** - Client-side scripting (via `resources/js/app.js`)
4. **Blade Templates** - Laravel's templating engine (`.blade.php` files)
   - Combines HTML + PHP + Blade directives

### **Asset Management & Build Tools**
1. **Vite 7.0.7** - Modern build tool (replaces Webpack)
   - Compiles CSS and JavaScript
   - Hot module replacement (HMR)
   - Fast development server
2. **Tailwind CSS 4.0** - Utility-first CSS framework
3. **Node.js & npm/yarn** - JavaScript runtime and package manager
   - Used for managing frontend dependencies
   - Running Vite build process

### **Package Managers**
1. **Composer** - PHP dependency manager
   - Manages PHP packages (Laravel, etc.)
2. **npm/yarn** - JavaScript package manager
   - Manages frontend packages (Vite, Tailwind, etc.)

## 📁 File Types & Languages in This Project

### **PHP Files** (`.php`)
- Controllers: `app/Http/Controllers/*.php`
- Models: `app/Models/*.php`
- Routes: `routes/*.php`
- Config: `config/*.php`
- Migrations: `database/migrations/*.php`

### **Blade Templates** (`.blade.php`)
- Views: `resources/views/*.blade.php`
- **Contains**: HTML + PHP + Blade syntax
- Example: `{{ $variable }}`, `@auth`, `@if`, etc.

### **CSS Files** (`.css`)
- `resources/css/app.css` - Tailwind CSS
- `resources/css/homepage.css` - Custom homepage styles
- Compiled by Vite to `public/build/`

### **JavaScript Files** (`.js`)
- `resources/js/app.js` - Main JavaScript file
- `resources/js/bootstrap.js` - Bootstrap configuration
- Compiled by Vite to `public/build/`

### **Configuration Files**
- `vite.config.js` - Vite configuration (JavaScript/ES6)
- `composer.json` - PHP dependencies
- `package.json` - JavaScript dependencies
- `.env` - Environment variables

## 🔧 Development Tools

1. **Laravel Artisan** - Command-line tool for Laravel
2. **Vite Dev Server** - Development server with hot reload
3. **PHPUnit** - Testing framework
4. **Laravel Tinker** - Interactive PHP shell

## 🗄️ Database

- **MySQL** - Relational database
- **Eloquent ORM** - Laravel's database abstraction layer
- **Migrations** - Database version control

## 📦 Key Dependencies

### PHP (via Composer)
- `laravel/framework` - Core Laravel framework
- `guzzlehttp/guzzle` - HTTP client
- `monolog/monolog` - Logging
- `symfony/*` - Symfony components

### JavaScript (via npm/yarn)
- `vite` - Build tool
- `laravel-vite-plugin` - Laravel integration
- `tailwindcss` - CSS framework
- `axios` - HTTP client for JavaScript

## 🎨 How They Work Together

```
┌─────────────────────────────────────────┐
│  Browser (Client)                       │
│  - HTML/CSS/JavaScript                  │
└──────────────┬──────────────────────────┘
               │ HTTP Request
               ▼
┌─────────────────────────────────────────┐
│  Laravel Server (PHP)                   │
│  - Routes → Controllers                  │
│  - Controllers → Models                  │
│  - Models → Database (MySQL)            │
│  - Controllers → Blade Views            │
└──────────────┬──────────────────────────┘
               │
               ▼
┌─────────────────────────────────────────┐
│  MySQL Database                          │
│  - Stores user data, sessions, etc.     │
└─────────────────────────────────────────┘

┌─────────────────────────────────────────┐
│  Vite Build Process (Node.js)           │
│  - Compiles CSS (homepage.css)          │
│  - Compiles JavaScript                  │
│  - Outputs to public/build/             │
└─────────────────────────────────────────┘
```

## 📝 Summary

**Languages Used:**
- ✅ PHP (Backend)
- ✅ HTML (Structure)
- ✅ CSS (Styling)
- ✅ JavaScript (Client-side)
- ✅ SQL (Database queries via Eloquent)

**Frameworks & Tools:**
- ✅ Laravel (PHP framework)
- ✅ Blade (Templating engine)
- ✅ Vite (Build tool)
- ✅ Tailwind CSS (CSS framework)
- ✅ MySQL (Database)

**This is a full-stack web application!** 🚀

