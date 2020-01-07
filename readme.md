# ColbyCMS

A Laravel CMS for Colby College.

## Getting Started

1. Clone repo: `git clone https://github.com/bwaltz/colbyCMS.git`
2. Run Composer: `composer install`
3. Create `.env` file with database credentials
4. Generate app key: `php artisan key:generate`
5. Run migrations and seeds: `php artisan migrate --seed`
6. Run webpack: `npm run watch`
7. Serve: `php artisan serve`
8. Play

## Notable Links

Admin dashboard - "/admin/dashboard"  
Admissions - "/admissions"  
Posts - "/posts"

## Dependencies

[Laravel Menu](https://github.com/lavary/laravel-menu)  
[Laravel Mediable](https://github.com/plank/laravel-mediable)  
[Laravel Permission](https://github.com/spatie/laravel-permission)  
[Revisionable](https://github.com/VentureCraft/revisionable)
