# EnzoTFA7

This is the IT0049 Technical Formative Assessment 7 project. It extends the Laravel POS application with validated create forms, edit/update workflows, and display-ready user avatar uploads.

## Pages

| URL | Purpose |
| --- | --- |
| `/` | Landing page |
| `/about` | Project overview |
| `/customers` | Customer Accounts listing retrieved with Eloquent |
| `/users` | User Accounts listing retrieved with Eloquent |
| `/customers/create` | Create a customer with validation |
| `/users/create` | Create a user with validation |
| `/customers/{id}/edit` | Edit and update a customer |
| `/users/{id}/edit` | Edit a user and upload an avatar |

## Local Laravel setup

1. Install PHP 8.2+, Composer, and Laravel's requirements.
2. Copy `.env.example` to `.env`.
3. Run `composer install`.
4. Run `php artisan key:generate`.
5. Create an empty SQLite file at `database/database.sqlite`, then run `php artisan migrate:fresh --seed`.
6. Run `php artisan storage:link` so prepared avatars are publicly visible.
7. Start the app with `php artisan serve` and open `http://127.0.0.1:8000`.

The Laravel entry point is `public/index.php`. The required routes are in `routes/web.php`, controllers are in `app/Http/Controllers`, Eloquent models are in `app/Models`, migrations are in `database/migrations`, and Blade views are in `resources/views`.

## InfinityFree upload

For the quickest shared-host upload, set the InfinityFree PHP version to 8.2 or newer, then upload the contents of this project into `htdocs`. The root `index.php` and `.htaccess` provide a self-contained fallback entry point when Composer cannot be run on the host; it includes the same create/edit validation and avatar upload workflow. The normal Laravel source files remain available for the GitHub submission and local Laravel setup.

For a full Laravel deployment with Composer dependencies, run `composer install --no-dev` locally, upload the resulting `vendor` directory and the full project, and point the domain document root to the `public` folder if the hosting plan allows it. Never upload a real `.env` file containing secrets.
