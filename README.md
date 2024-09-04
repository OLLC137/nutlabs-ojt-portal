
## Laravel Boilerplate

This is a Laravel boilerplate application designed to simplify the setup process for new projects. Follow the steps below to get your application up and running.

Requirements

- PHP: Version 8.2 or higher
- Node.js: Version 18.13.0 or higher

## Installation 

<h3>Config File</h3>

copy `.env.example` `.env`

Open the .env file and update the following configurations

```
APP_URL=http://localhost
APP_ROOT=

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE='database_name'
DB_USERNAME='database_username'
DB_PASSWORD='database_password'
```

Ensure you replace the placeholders with your database credentials and any other environment-specific settings.

Below is the example first admin details

```
ADMIN_USERNAME="admin"
ADMIN_PASSWORD="password"
ADMIN_NAME="Administrator"
ADMIN_EMAIL="admin@admin.com"
```

<h3> Install PHP Dependencies & Setup </h3>

```
$ composer install
$ php artisan migrate
$ php artisan db:seed
$ php artisan key:generate
```

<h3> Install Node Dependencies & Setup</h3>

```
$ npm install
$ npm run build
```

<h3> Running the Application </h3>

```
$ php artisan serve
```
