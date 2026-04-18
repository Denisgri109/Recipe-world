#!/bin/bash

# ============================================================
# Azure App Service Startup Script for Laravel
# This runs each time the container starts.
# ============================================================

echo ">>> Starting Laravel Azure startup script..."

# Copy custom Nginx configuration
cp /home/site/wwwroot/default /etc/nginx/sites-available/default
service nginx reload

echo ">>> Nginx configuration applied."

# Ensure storage directories exist and are writable
mkdir -p /home/site/wwwroot/storage/framework/cache/data
mkdir -p /home/site/wwwroot/storage/framework/sessions
mkdir -p /home/site/wwwroot/storage/framework/views
mkdir -p /home/site/wwwroot/storage/logs
mkdir -p /home/site/wwwroot/bootstrap/cache

# Set permissions
chmod -R 775 /home/site/wwwroot/storage
chmod -R 775 /home/site/wwwroot/bootstrap/cache
chown -R www-data:www-data /home/site/wwwroot/storage
chown -R www-data:www-data /home/site/wwwroot/bootstrap/cache

echo ">>> Storage directories created and permissions set."

cd /home/site/wwwroot

# Clear and rebuild caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ">>> Caches rebuilt."

# Run migrations
php artisan migrate --force

echo ">>> Migrations complete."

# Create storage symlink (public/storage -> storage/app/public)
php artisan storage:link --force 2>/dev/null || true

echo ">>> Storage link created."

echo ">>> Laravel startup complete!"
