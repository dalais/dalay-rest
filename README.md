## Тестовое приложение

Framework: Laravel

- `git clone git@github.com:dalais/dalay-rest.git`
- `composer install`
- `php artisan key:generate`
- create and connect db
- `php artisan migrate`
- Create test data `php artisan db:seed --class=TestDataSeeder`
- Create client (jwt) `php artisan passport:install`
- Run app `php artisan serve`

Authorization:

Route: `POST http://127.0.0.1:8000/oauth/token`

Post body:

    `{
    "grant_type": "password",
    "client_id": 2,
    "client_secret":"" //secret,
    "username": "admin@example.com",
    "password": "password"
    }`
