docker compose up -d --build

docker exec -it open-api-app /bin/bash

settings .env

php artisan key:generate

php artisan make:migrations

php artisan db:seed

php artisan jwt:secret

php artisan test