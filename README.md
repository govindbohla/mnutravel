# MNU Travels

A taxi, outstation cab, and tour package booking platform with a full admin CMS, built on Laravel 12. Every piece of frontend content (vehicles, services, tour packages, testimonials, FAQs, pages, menus, SEO, contact details, site settings) is managed from the admin panel — nothing on the public site is hardcoded.

## Tech Stack

- **Backend**: Laravel 12, PHP 8.2+, MySQL
- **Frontend**: Blade, Bootstrap 5, jQuery, Font Awesome, Poppins font — all loaded via CDN, no Node/npm/Vite build step anywhere
- **Admin panel**: AdminLTE 3 (`jeroennoten/laravel-adminlte`) — note this bundles Bootstrap 4, isolated from the public site's Bootstrap 5
- **Auth**: Laravel Breeze (blade stack, restyled to Bootstrap 5)
- **Authorization**: Spatie Laravel Permission (roles: Admin, Sub Admin, Helpliner)
- **Images**: Laravel Storage + Intervention Image (resize/optimize on upload)
- **Activity logging**: Spatie Activitylog
- **Sitemap**: Spatie Laravel Sitemap
- **Architecture**: Repository + Service layer, Form Request validation, one controller per resource

## Local Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
# Point DB_* in .env at a MySQL database, then:
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Seeded admin login: `admin@mnutravels.com` / `Password@123` (change this immediately after first login in production).

No `npm install` or build step is required at any point — all frontend assets (Bootstrap, Font Awesome, jQuery, Poppins) are CDN-hosted, and the small amount of custom CSS/JS lives directly in `public/assets/`.

## Deploying to cPanel Shared Hosting

1. **Upload the code.** Either `git clone` via cPanel's Git Version Control feature, or zip and upload everything *except* `vendor/` and upload that separately (or run `composer install` via cPanel's Terminal/SSH if available).
2. **Point the domain at `public/`.** Either set the subdomain/addon domain's document root directly to the `public/` folder, or — if you can't change the document root — copy `public/index.php` to your home directory's `public_html`, and edit the two `require`/`__DIR__` paths in it to point at the real `bootstrap/app.php` and `public/` locations of the uploaded project.
3. **Create the MySQL database** and a database user via cPanel's MySQL Databases tool, and grant that user all privileges on the database.
4. **Set up `.env`.** Copy `.env.example` to `.env`, fill in `DB_*` with the cPanel database credentials, set `APP_URL` to the real domain, `APP_ENV=production`, `APP_DEBUG=false`, and configure `MAIL_*` with your SMTP provider (cPanel's own mail service or an external one). Set `ADMIN_NOTIFICATION_EMAIL` and `WHATSAPP_NUMBER` to real values.
5. **Install dependencies and generate the key** (via SSH/Terminal if available):
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan key:generate
   ```
6. **Run migrations and seed:**
   ```bash
   php artisan migrate --force --seed
   ```
7. **Link storage.** `php artisan storage:link` creates a symlink from `public/storage` to `storage/app/public`. Most cPanel hosts support symlinks; if yours doesn't, manually create the equivalent directory alias or copy uploaded files into `public/storage` after each upload as a fallback.
8. **Cache for production:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
   Re-run these three after any subsequent code deploy (`config:clear` / `route:clear` / `view:clear` first if you need to debug something live).
9. **Set folder permissions.** `storage/` and `bootstrap/cache/` need to be writable by the web server user (typically `755` or `775` depending on the host, never `777`).
10. **Update the admin password** for `admin@mnutravels.com` immediately after first login, and review Website Settings (logo, WhatsApp number, contact details, social links) in the admin panel.

### If PHP's `intl`/GD extension isn't enabled

Intervention Image needs the GD (or Imagick) PHP extension for image uploads to work. Most cPanel hosts have GD enabled by default; if uploads fail with a driver error, enable `gd` via cPanel's "Select PHP Version" → extensions screen.

## Admin Panel

- URL: `/login`, then any authenticated user lands on `/admin/dashboard`
- Roles: **Admin** (full access), **Sub Admin** (everything except Settings/Users/Roles), **Helpliner** (Bookings/Enquiries/Customers only)
- Every CMS module (Bookings, Enquiries, Customers, Vehicles, Vehicle Categories, Services, Tour Packages, Testimonials, FAQ, Gallery, Hero Sliders, Pages, Menu Manager, Footer Manager, SEO Manager, Contact Details, Website Settings, Users, Roles & Permissions, Activity Log, Error Log) is reachable from the sidebar, gated by permission
