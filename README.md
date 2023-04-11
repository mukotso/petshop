<p align="center">PETSHOP ECOMMERCE </p>

## Installation With Docker

Run composer install

```bash
composer install 
```

Copy the .env.example. Create a .env file and paste.

```bash
cp .env.example .env or copy .env.example .env
```

Generate key

```bash
php artisan key:generate
```

Before running migration ensure you have created your database

```bash
php artisan migrate
```

Seed data to database

```bash
php artisan db:seed
```

Start your application

```bash
php artisan serve
```

## Login Credentials
Admin Email:  admin@buckhill.co.uk
Admin Password: admin

For all seeded user's, the password is: userpassword


## Generating Swagger API Documentation
Run this command.
```bash
php artisan l5-swagger:generate 
```


## Running Test

Before running test, I recommend running your seeders for accurate test result.

Running tests

Run php artisan test
