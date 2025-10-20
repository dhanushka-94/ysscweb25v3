# YSSC Football Club Website

A modern, responsive website for Young Silver Sports Club built with Laravel 11 and Tailwind CSS.

## Features

### 🏠 **Frontend**
- **Homepage** with hero slider, upcoming fixtures, latest news, and gallery
- **About Pages** - History, Club info, Arena details, Office Bearers, Bank Details
- **SportsPress** - League standings and fixtures
- **Gallery** - Image gallery with bulk upload functionality
- **News** - Latest club news and announcements
- **Shop** - Product catalog
- **Sponsors** - Sponsor showcase
- **Contact** - Contact form with Google Maps integration

### ⚽ **Football Theme**
- Yellow color scheme matching club identity
- Football-themed background animations
- Responsive design for all devices
- Professional navigation with dropdown menus

### 🔧 **Admin Panel**
- **Dashboard** with statistics and quick actions
- **CRUD Operations** for:
  - Sliders (Homepage hero images)
  - News articles
  - Team members
  - Fixtures
  - Gallery images (with bulk upload)
  - Sponsors
  - Shop products
  - Office Bearers (with hierarchical categories)
- **Settings** - Site logo, name, and tagline management

### 📱 **Technical Features**
- Laravel 11 with Blade templating
- Tailwind CSS for styling
- MySQL database
- Image upload and storage
- SEO optimized
- Mobile responsive
- Admin authentication

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/dhanushka-94/ysscweb25v3.git
   cd ysscweb25v3
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   - Create a MySQL database named `yssc_football`
   - Update `.env` with your database credentials
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Storage setup**
   ```bash
   php artisan storage:link
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the server**
   ```bash
   php artisan serve
   ```

## Admin Access

- **URL:** `/admin`
- **Default Admin User:** Check `ADMIN_CREDENTIALS.md` for login details

## Office Bearers Categories

The system includes hierarchical categories for office bearers:

1. **Executive Committee** - President, Vice President, Secretary, etc.
2. **Committee Members** - Committee Member, Executive Committee Member
3. **Sports Management** - Team Manager, Head Coach, Assistant Coach, etc.
4. **Administration** - Public Relations Officer, Media Coordinator, etc.
5. **Advisors** - Chief Patron, Patron, Advisor

## Development

- **Frontend:** Tailwind CSS with custom yellow theme
- **Backend:** Laravel 11 with Eloquent ORM
- **Database:** MySQL with migrations
- **Authentication:** Laravel Breeze
- **File Storage:** Laravel Storage with public disk

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

This project is proprietary software for Young Silver Sports Club.

## Contact

For support or questions, contact the development team at [olexto.com](https://olexto.com)

---

**Developed by olexto Digital Solutions (Pvt) Ltd**