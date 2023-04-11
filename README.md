<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# buckhill-petshop

Buckhill ecommerce petshop test by Reuben Arinze

## Feature And Functionalites Implemented

Bearer Token authentication
Middleware protection
Admin endpoint: - All users listing (non-admins) - Edit and Delete user’s accounts -Admins accounts cannot be deleted or edited
User endpoint: Login/logout, -forgot/reset password
Customer orders
Order invoice download

## Installation

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
