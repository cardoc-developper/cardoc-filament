#!/usr/bin/env bash

echo "Installing composer dependencies"

## Install composer dependencies
composer update
composer dump-autoload

echo "Installing npm dependencies"

echo "Installing npm dependencies and starting vite dev"
npm i
npm run dev -- --port=5173 --host=0.0.0.0 >/dev/null 2>&1 &

echo "Setting the right permission on the storage folder"

php artisan storage:link

touch storage/logs/laravel.log

chmod -R 775 storage
chown -R www-data:www-data storage
chgrp -R www-data storage


echo "Starting Horizon Process"

## Start the horizon process
php artisan horizon >/dev/null 2>&1 &

echo "Starting the scheduler process"

## Start the horizon process
php artisan schedule:work >/dev/null 2>&1 &

echo "Starting the web server"
## Start the web server
service php8.3-fpm start
nginx -g 'daemon off;'
