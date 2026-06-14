#!/bin/bash

# Pastikan environment variable production sudah diset
export APP_ENV=production
export APP_DEBUG=false

# Jalankan optimasi Laravel untuk kecepatan
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migrasi dan seeder secara otomatis (abaikan prompt yes/no)
php artisan migrate --force --seed

# Buat link storage (bila belum ada)
php artisan storage:link

# Jalankan server web Apache di latar depan (foreground)
exec apache2-foreground
