#!/bin/bash
cd /var/www

# ===== SETUP SQLITE DATABASE =====
mkdir -p /var/www/database
touch /var/www/database/database.sqlite
chmod 664 /var/www/database/database.sqlite
chown www-data:www-data /var/www/database/database.sqlite

# ===== CLEAR & CACHE CONFIG =====
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# ===== RUN MIGRATIONS + SEED =====
echo "🚀 Running migrations..."
php artisan migrate --force

echo "🌱 Running seeders (demo data)..."
php artisan db:seed --force || echo "Seeder skipped"

# ===== CACHE OPTIMASI =====
php artisan config:cache
php artisan route:cache

# ===== STORAGE LINK =====
php artisan storage:link || true

# ===== SET PERMISSIONS =====
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/database
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache
chmod -R 775 /var/www/database

# ===== START SUPERVISOR =====
mkdir -p /var/log/supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
