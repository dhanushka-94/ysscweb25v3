# 🔐 Admin & User Credentials

## Sample Users Created ✅

### 👨‍💼 Admin User (Full Access)

**Access Admin Panel:**
```
URL: http://localhost:8000/login

Email: admin@ysscfc.com
Password: admin123
```

**Permissions:**
- ✅ Full admin access
- ✅ Can manage all content
- ✅ Access to `/admin` dashboard
- ✅ Can create/edit/delete sliders, news, team, fixtures, gallery, sponsors, products

---

### 👤 Regular Users (No Admin Access)

#### User 1
```
Email: john@example.com
Password: password123
```
- ❌ No admin access
- ✅ Can login to website
- ✅ Regular user permissions

#### User 2
```
Email: jane@example.com
Password: password123
```
- ❌ No admin access
- ✅ Can login to website
- ✅ Regular user permissions

---

## 🚀 Quick Access

### Admin Dashboard
1. Go to: **http://localhost:8000/login**
2. Use admin credentials:
   - **Email**: `admin@ysscfc.com`
   - **Password**: `admin123`
3. After login, go to: **http://localhost:8000/admin**

### Direct URLs
- **Login Page**: http://localhost:8000/login
- **Admin Dashboard**: http://localhost:8000/admin
- **Manage Sliders**: http://localhost:8000/admin/sliders
- **Manage News**: http://localhost:8000/admin/news
- **Manage Team**: http://localhost:8000/admin/team
- **Manage Gallery**: http://localhost:8000/admin/gallery

---

## 📝 Notes

- **Admin account** has `is_admin = 1` in database
- **Regular users** have `is_admin = 0` in database
- All passwords are hashed in database
- You can change passwords after first login
- You can create more users via registration page

---

## 🔒 Security Recommendations

### For Production:
1. **Change all passwords immediately**
2. **Use strong passwords** (min 12 characters, mixed case, numbers, symbols)
3. **Remove test users** (john, jane)
4. **Use unique email addresses**
5. **Enable two-factor authentication** (optional enhancement)

### Change Password:
1. Login to admin panel
2. Click on your name (top right)
3. Go to Profile
4. Update password

---

## ✅ Verification

To verify users were created:

```bash
# In terminal
php artisan tinker

# Then run:
User::all();
# or
User::where('is_admin', true)->get();
```

Or check in phpMyAdmin:
- Database: `yssc_football`
- Table: `users`
- Should see 3 users

---

## 🎯 What You Can Do Now

### As Admin (admin@ysscfc.com):
1. ✅ Login at http://localhost:8000/login
2. ✅ Access admin dashboard at http://localhost:8000/admin
3. ✅ Manage sliders (full CRUD available)
4. ✅ View statistics
5. ✅ Add news, team members, fixtures, gallery images, sponsors, products

### As Regular User (john or jane):
1. ✅ Login at http://localhost:8000/login
2. ✅ View public content
3. ❌ Cannot access /admin (will get 403 error)

---

## 🔄 Reset/Recreate Users

If you need to recreate users:

```bash
# Clear users table
php artisan migrate:fresh

# Run all migrations again
php artisan migrate

# Seed users again
php artisan db:seed --class=UserSeeder

# Also seed slider if needed
php artisan db:seed --class=SliderSeeder
```

---

## 📞 Quick Reference

| What | Details |
|------|---------|
| **Admin Email** | admin@ysscfc.com |
| **Admin Password** | admin123 |
| **Login URL** | http://localhost:8000/login |
| **Admin Panel** | http://localhost:8000/admin |
| **Database Table** | users |
| **Admin Field** | is_admin = 1 |

---

## 🎉 You're Ready!

You can now:
1. Login with admin credentials
2. Access the admin panel
3. Start managing your football club website
4. Add sliders, news, team members, and more!

**Happy Managing! ⚽🎊**

