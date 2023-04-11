<h1 align="center">PETSHOP ECOMMERCE </h1>

## Getting Started
Clone this project to your local machine and open it in your favourite IDE
```bash
git clone https://github.com/mukotso/petshop.git
```
##Running locally
Copy .env.example to .env. by running the following command in your terminal

```bash
cp .env.example .env 
```

## Installation With Docker
I have included docker-compose.yml and Dockerfile together with scripts (install.sh) to handle the installation of the required services and dependencies  and (uninstall.sh) - destroy created docker containers.

Give execution permission to this scripts by running
```bash
chmod +x install.sh 
chmod +x uninstall.sh 
```
Now run the install script to create petshop container, apache configuration,MySQL database container , it will compose this containers and start them in detached mode


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
