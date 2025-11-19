# Stocks API - DKInfoway

**Important**: I intentionally used laravel V9 instead of V12(Latest) assuming that your machine might running on older PHP version.

## Steps to run locally

1. Require PHP 8+, MySQL, Composer.
2. Unzip this project.
3. Copy `.env.example` to `.env` and update DB credentials.
4. Run `composer install`.
5. Generate app key: `php artisan key:generate`
6. Run migrations: `php artisan migrate`
7. Run seeders: `php artisan db:seed`
7. Install Passport: `php artisan passport:install` then add ID and Secrect in the .env
8. Serve: `php artisan serve`

## Endpoints

- POST /api/register
- POST /api/login
- GET /api/stores (auth)
- GET /api/stocks?page=1&size=5 (auth)
- POST /api/stocks/bulk (auth)
- DELETE /api/stocks/<id> (auth)
- POST /api/logout (auth)

## Notes

- After `passport:install` you'll get client id/secret; update `.env` if needed.
- Scheduler command `stocks:update-status` is provided to update statuses daily.