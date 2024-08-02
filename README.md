## About Laravel

Composer install

CREATE DATABASE `test-konnco` /_!40100 DEFAULT CHARACTER SET utf8mb4 _/;
in env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test-konnco
DB_USERNAME=root
DB_PASSWORD=

add midtrans server and client key
MIDTRANS_SERVER_KEY=your-server-key
MIDTRANS_CLIENT_KEY=your-client-key
MIDTRANS_IS_PRODUCTION=false

php artisan migrate
php artisan db:seed --class=ProductSeeder
php artisan serve
