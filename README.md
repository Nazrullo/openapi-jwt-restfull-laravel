docker compose up -d --build

settings .env

php artisan key:generate

php artisan make:migrations

php artisan db:seed

unit test

php artisan test