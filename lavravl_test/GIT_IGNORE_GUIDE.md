# Git Ignore Guide for Laravel Projects 📝

## ✅ **MIGRATION FILES - COMMIT TO GIT!**

**IMPORTANT:** Migration files (`.php` files in `database/migrations/`) **SHOULD BE COMMITTED** to Git!

### Why?
- ✅ They are **code**, not data
- ✅ Team members need them to build the same database structure
- ✅ They're part of your application's version control
- ✅ Everyone should have the same migrations

**Example files to COMMIT:**
```
✅ database/migrations/2025_11_23_061129_add_role_to_users_table.php
✅ database/migrations/2025_11_23_061129_create_products_table.php
✅ All migration files in database/migrations/
```

---

## 🚫 **What Should Be Ignored (.gitignore)**

### 1. **Environment Files** (Already in .gitignore ✅)
```
.env
.env.backup
.env.production
.env.local
```
**Why?** Contains sensitive data (database passwords, API keys, secrets)

### 2. **Dependencies** (Already in .gitignore ✅)
```
/vendor          ← PHP packages (Composer)
/node_modules    ← JavaScript packages (npm/yarn)
```
**Why?** Can be reinstalled with `composer install` and `npm install`

### 3. **Build/Cache Files** (Already in .gitignore ✅)
```
/public/build    ← Compiled CSS/JS (Vite output)
/public/hot      ← Vite dev server file
/public/storage   ← Symlinked storage
```
**Why?** Generated files, can be rebuilt

### 4. **Storage & Logs** (Already in .gitignore ✅)
```
/storage/*.key
/storage/pail
/storage/logs/*.log
```
**Why?** Logs and cache files change frequently

### 5. **IDE/Editor Files** (Already in .gitignore ✅)
```
/.vscode
/.idea
/.fleet
/.zed
.phpactor.json
```
**Why?** Personal editor settings

### 6. **System Files** (Already in .gitignore ✅)
```
.DS_Store        ← macOS
Thumbs.db        ← Windows
*.log            ← Log files
```

---

## ✅ **What SHOULD Be Committed to Git**

### **Application Code:**
```
✅ app/                    ← All PHP controllers, models, etc.
✅ config/                 ← Configuration files
✅ database/migrations/    ← ALL migration files
✅ database/seeders/       ← Database seeders
✅ database/factories/     ← Model factories
✅ resources/              ← Views, CSS, JS source files
✅ routes/                 ← Route definitions
✅ public/                 ← Public assets (except build/)
✅ tests/                  ← Test files
✅ composer.json           ← PHP dependencies list
✅ package.json            ← JavaScript dependencies list
✅ vite.config.js          ← Vite configuration
✅ phpunit.xml             ← PHPUnit configuration
```

### **Documentation:**
```
✅ README.md
✅ *.md files (documentation)
```

---

## 📋 **Your Current .gitignore (Review)**

Your `.gitignore` already has most things correct! ✅

**Current .gitignore includes:**
- ✅ `.env` files
- ✅ `vendor/`
- ✅ `node_modules/`
- ✅ `public/build`
- ✅ `public/storage`
- ✅ Storage cache files
- ✅ IDE files
- ✅ System files

**This is correct!** 👍

---

## 🔍 **What About Database Files?**

### **SQLite Database** (if using)
```
❌ database/database.sqlite  ← Should be ignored
```
**Why?** Contains actual data, not structure

**Add to .gitignore:**
```
/database/*.sqlite
/database/*.db
```

### **But Migrations:**
```
✅ database/migrations/*.php  ← COMMIT these!
```

---

## 🎯 **Quick Checklist**

### ✅ **COMMIT These:**
- [x] All PHP files in `app/`
- [x] All migration files in `database/migrations/`
- [x] All Blade templates in `resources/views/`
- [x] CSS/JS source files in `resources/css/` and `resources/js/`
- [x] Configuration files in `config/`
- [x] Route files in `routes/`
- [x] `composer.json` and `package.json`
- [x] `vite.config.js`

### ❌ **IGNORE These:**
- [x] `.env` files
- [x] `vendor/` folder
- [x] `node_modules/` folder
- [x] `public/build/` (compiled assets)
- [x] `storage/logs/` (log files)
- [x] Database files (`.sqlite`, `.db`)
- [x] IDE configuration folders

---

## 💡 **Best Practice Summary**

### **Rule of Thumb:**
- ✅ **Code** → Commit to Git
- ❌ **Data/Generated files** → Ignore

### **Migration Files:**
```
✅ COMMIT: database/migrations/*.php
❌ IGNORE: database/*.sqlite (actual database file)
```

### **Why This Matters:**
1. **Team Collaboration** - Everyone needs the same migrations
2. **Version Control** - Track database structure changes
3. **Deployment** - Production needs migrations to build database
4. **Reproducibility** - New developers can set up the same database

---

## 🚨 **Common Mistakes to Avoid**

### ❌ **DON'T Ignore:**
- Migration files
- Seeders
- Configuration files (except .env)
- Source code

### ✅ **DO Ignore:**
- Environment variables (.env)
- Dependencies (vendor, node_modules)
- Build outputs (public/build)
- Log files
- Database files with actual data

---

## 📝 **If You Need to Add Something**

If you want to ignore database files, add this to `.gitignore`:

```
# Database files
/database/*.sqlite
/database/*.db
```

But **keep migrations** committed! ✅

---

## 🎓 **Summary**

**Migration files = CODE → COMMIT ✅**

**Your current .gitignore is good!** Just make sure:
- ✅ Migration files are committed
- ✅ .env files are ignored
- ✅ vendor/node_modules are ignored
- ✅ Build files are ignored

**Everything else in your .gitignore looks correct!** 👍

