#!/bin/bash

# Create directories if they don't exist
mkdir -p storage/app/public/img/avatar

# Set proper permissions
chmod -R 775 storage/app/public

# 1. Create storage link
php artisan storage:link

# 2. Clear cache (optional but recommended)
php artisan optimize:clear

# 3. Start your Laravel app (REQUIRED to prevent 502)
php artisan serve --port=${PORT:-8080} --host=0.0.0.0