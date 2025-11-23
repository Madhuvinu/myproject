# How to Access Admin Dashboard 🚀

## Step-by-Step Guide

### **Step 1: Run Database Migrations**

First, you need to create all the database tables:

```bash
cd lavravl_test
php artisan migrate
```

**What this does:**
- Creates `users` table (with `role` column)
- Creates `products` table
- Creates `orders` table
- Creates `order_items` table
- Creates `cart_items` table

---

### **Step 2: Create an Admin User**

You need to make at least one user an admin. There are **2 ways**:

#### **Option A: Make Existing User Admin (Recommended)**

If you already have a user account:

1. **Open Laravel Tinker:**
```bash
php artisan tinker
```

2. **Find your user and make them admin:**
```php
$user = App\Models\User::where('email', 'your-email@example.com')->first();
$user->role = 'admin';
$user->save();
exit
```

Replace `your-email@example.com` with your actual email.

#### **Option B: Create New Admin User via Tinker**

```bash
php artisan tinker
```

Then run:
```php
$user = new App\Models\User();
$user->name = 'Admin User';
$user->email = 'admin@example.com';
$user->password = bcrypt('password123');
$user->role = 'admin';
$user->save();
exit
```

---

### **Step 3: Login as Admin**

1. **Go to your website:**
```
http://127.0.0.1:8000
```

2. **Click on the user icon** (top right) to open login modal

3. **Login with your admin credentials:**
   - Email: (the one you set as admin)
   - Password: (your password)

---

### **Step 4: Access Admin Dashboard**

Once logged in as admin, go to:

```
http://127.0.0.1:8000/admin/dashboard
```

**Or click the link in your header** (if you add one)

---

## 🔐 Admin Dashboard URLs

Once logged in as admin, you can access:

| Page | URL |
|------|-----|
| **Dashboard** | `http://127.0.0.1:8000/admin/dashboard` |
| **Products** | `http://127.0.0.1:8000/admin/products` |
| **Add Product** | `http://127.0.0.1:8000/admin/products/create` |
| **Orders** | `http://127.0.0.1:8000/admin/orders` |
| **Users** | `http://127.0.0.1:8000/admin/users` |

---

## 🛡️ Security

- **Only users with `role = 'admin'` can access admin routes**
- **Regular users will get "403 Forbidden" error** if they try to access admin pages
- **Admin middleware checks** the user's role before allowing access

---

## ✅ Quick Checklist

- [ ] Run `php artisan migrate` (creates database tables)
- [ ] Create/admin user account (via registration or tinker)
- [ ] Set user's `role` to `'admin'` in database
- [ ] Login with admin credentials
- [ ] Visit `http://127.0.0.1:8000/admin/dashboard`

---

## 🐛 Troubleshooting

### **Error: "403 Forbidden" or "Unauthorized access"**
- **Solution:** Your user's `role` is not set to `'admin'`
- **Fix:** Use tinker to set `$user->role = 'admin'`

### **Error: "Table doesn't exist"**
- **Solution:** Run `php artisan migrate` first

### **Error: "Route not found"**
- **Solution:** Make sure you're logged in
- **Fix:** Login first, then access admin routes

### **Can't see admin dashboard**
- **Check:** Are you logged in?
- **Check:** Is your user role set to 'admin'?
- **Check:** Are you accessing `/admin/dashboard` URL?

---

## 🎯 What You Can Do in Admin Dashboard

### **1. Dashboard (`/admin/dashboard`)**
- View statistics (total users, orders, products, revenue)
- See recent orders
- See recent users

### **2. Products (`/admin/products`)**
- View all products
- Add new products
- Edit products
- Delete products
- Upload product images
- Manage inventory (stock quantity)

### **3. Orders (`/admin/orders`)**
- View all orders
- See order details
- Update order status (pending → processing → shipped → delivered)
- View customer information

### **4. Users (`/admin/users`)**
- View all registered users
- See user details
- View user's order history

---

## 📝 Example: Making Your First Admin

**If you just registered a user:**

1. **Run tinker:**
```bash
php artisan tinker
```

2. **Make yourself admin:**
```php
$user = App\Models\User::where('email', 'your-email@example.com')->first();
$user->role = 'admin';
$user->save();
echo "User {$user->name} is now admin!";
exit
```

3. **Login and go to:**
```
http://127.0.0.1:8000/admin/dashboard
```

---

## 🚀 Ready to Go!

Once you complete these steps, you'll have full access to the admin dashboard! 🎉

