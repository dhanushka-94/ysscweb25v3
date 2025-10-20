# Quick Start Guide - YSSC Football Club Website

## 🚀 Getting Started (5 Minutes)

### Step 1: Database Setup
1. Open XAMPP Control Panel
2. Start **Apache** and **MySQL**
3. Open phpMyAdmin: http://localhost/phpmyadmin
4. Create new database: `yssc_football`
5. Run migrations:
```bash
php artisan migrate
```

### Step 2: Create Storage Link
```bash
php artisan storage:link
```

### Step 3: Start the Server
```bash
php artisan serve
```

Your website is now live at: **http://localhost:8000**

---

## 👤 Create Admin Account

### Method 1: Register on Website
1. Visit: http://localhost:8000/register
2. Fill in your details and register
3. Open phpMyAdmin → `yssc_football` database → `users` table
4. Find your user, click Edit
5. Set `is_admin` = **1**
6. Save

### Method 2: Database Seeder (Optional)
Create a seeder file:
```bash
php artisan make:seeder AdminUserSeeder
```

---

## 🎨 What's Included

### ✅ Public Pages (Already Built)
- **Home** - Hero section, fixtures, news, gallery preview
- **About**
  - Our History
  - The Club
  - Arena
  - Office Bearers
  - Bank Details
- **SportsPress**
  - League standings
  - Fixtures & Results
- **Sponsors** - Tiered sponsor display
- **Gallery** - Photo gallery with categories
- **Shop** - Product catalog
- **Contact** - Contact form
- **News** - News articles & blog

### 🔐 Admin Panel (Basic Setup Complete)
Access at: http://localhost:8000/admin

**Dashboard shows:**
- Content statistics
- Quick action buttons
- Recent news
- Upcoming fixtures

**Admin Routes Created:**
- `/admin/news`
- `/admin/fixtures`
- `/admin/gallery`
- `/admin/products`
- `/admin/sponsors`
- `/admin/office-bearers`
- `/admin/about-content`

---

## 📝 Next Steps

### To Complete Admin Functionality:

1. **Create Admin Controllers** (See ADMIN_SETUP.md)
```bash
php artisan make:controller Admin/AdminNewsController --resource
```

2. **Create Admin Views** 
   - Copy the dashboard pattern
   - Create index, create, edit views for each section

3. **Add Sample Content**
   - Use the admin panel or tinker:
```bash
php artisan tinker
```

Example:
```php
News::create([
    'title' => 'Welcome to YSSC FC',
    'slug' => 'welcome-to-yssc-fc',
    'excerpt' => 'We are excited to launch our new website!',
    'content' => 'Full article content here...',
    'is_published' => true,
    'published_at' => now(),
]);
```

---

## 🎨 Theme Customization

### Color Scheme
The site uses a **professional yellow** theme:
- Primary: `#eab308` (yellow-500)
- Accent: `#facc15` (yellow-400)
- Light: `#fef08a` (yellow-200)

### Changing Colors
Edit `resources/css/app.css`:
```css
--color-primary-500: #YOUR_COLOR;
```

Then rebuild:
```bash
npm run build
```

---

## 🖼️ Adding Images

### File Structure
```
storage/app/public/
├── news/          # News featured images
├── gallery/       # Gallery images
├── products/      # Product images
├── sponsors/      # Sponsor logos
└── office-bearers/ # Member photos
```

### Uploading Images
Images can be uploaded through:
1. Admin panel (when controllers are completed)
2. Directly to `storage/app/public/` folders
3. Via API or file manager

**Remember:** Storage link must be created first!
```bash
php artisan storage:link
```

---

## 🔧 Common Commands

### Development
```bash
# Start server
php artisan serve

# Watch for changes
npm run dev

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Production
```bash
# Build assets
npm run build

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📱 Mobile Responsive

All pages are fully responsive and tested on:
- Desktop (1920px+)
- Laptop (1024px)
- Tablet (768px)
- Mobile (375px)

---

## 🎯 Key Features

✅ Professional yellow theme  
✅ Light mode (no dark mode)  
✅ Fully responsive design  
✅ SEO-friendly URLs  
✅ Image optimization ready  
✅ User authentication  
✅ Admin role system  
✅ MySQL database  
✅ Laravel 12 (latest)  
✅ Tailwind CSS  
✅ Vite build tool  

---

## 📞 Need Help?

### Check These Files:
- `README.md` - Full documentation
- `ADMIN_SETUP.md` - Admin controller guide
- `.env` - Configuration settings

### Troubleshooting:
1. **Database errors?** Check XAMPP is running
2. **CSS not loading?** Run `npm run build`
3. **Images not showing?** Run `php artisan storage:link`
4. **403 errors?** Check `is_admin` = 1 in database

---

## 🎉 You're Ready!

Your YSSC Football Club website is set up and ready to go!

**Next:** Add content through the admin panel and customize the design to match your club's branding.

**Visit your site:** http://localhost:8000  
**Admin panel:** http://localhost:8000/admin

---

Made with ❤️ using Laravel 12 & Tailwind CSS

