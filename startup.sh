#!/bin/bash

# ============================================================
# Azure App Service Startup Script for Laravel
# Runs each time the container starts, BEFORE php-fpm.
# Must complete quickly — slow/hanging commands block php-fpm.
# ============================================================

echo ">>> Starting Laravel Azure startup script..."

cd /home/site/wwwroot

# Copy custom Nginx configuration
if [ -f /home/site/wwwroot/default ]; then
    cp /home/site/wwwroot/default /etc/nginx/sites-available/default
    service nginx reload 2>/dev/null || true
    echo ">>> Nginx configuration applied."
fi

# Ensure storage directories exist and are writable
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R www-data:www-data storage 2>/dev/null || true
chown -R www-data:www-data bootstrap/cache 2>/dev/null || true

echo ">>> Storage directories ready."

# Clear caches (these are fast and don't need DB)
php artisan config:clear 2>&1 || true
php artisan cache:clear 2>&1 || true
php artisan view:clear 2>&1 || true
php artisan route:clear 2>&1 || true

echo ">>> Caches cleared."

# Build config cache (does NOT need DB connection)
php artisan config:cache 2>&1 || true
php artisan route:cache 2>&1 || true
php artisan view:cache 2>&1 || true

echo ">>> Caches rebuilt."

# Run migrations in the background so they don't block php-fpm startup
# Output goes to storage/logs/migration.log for debugging
nohup bash -c 'cd /home/site/wwwroot && php artisan migrate --force 2>&1 >> storage/logs/migration.log' &

echo ">>> Migrations started in background."

# Create storage symlink
php artisan storage:link --force 2>&1 || true

echo ">>> Laravel startup complete! PHP-FPM will start next."
