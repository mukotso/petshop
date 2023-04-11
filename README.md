<h1 align="center">PETSHOP ECOMMERCE </h1>

## Getting Started
Clone this project to your local machine and open it in your favourite IDE
```bash
git clone https://github.com/mukotso/petshop.git
```
## Running locally
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

```bash
 ./install.sh 
```

Because everything is now handle by Docker, We will run everything inside the container.
Run the following command in your project terminal

```bash
 docker exec -it petshop /bin/bash
```
You terminal should be inside the petshop container


## Generate  APP key

```bash
php artisan key:generate
```

## Run migrations
This will create our tables
```bash
php artisan migrate
```

## Seed data to database

```bash
php artisan db:seed
```

## Generate IDE Helper
Run the following command inside the container.
```bash
php artisan ide-helper:generate
```
## Larastan and PHP Insights
Run the following command inside the container.

```bash
  php artisan insights
```

## Default Login Credentials
Admin Email:  admin@buckhill.co.uk
Admin Password: admin



View the swagger documentation in below url
[Petshop Documentation](http://localhost:8082/api/petshop-documentation)



## Running Test

Before running test, I recommend running your seeders for accurate test result.

Running tests
Inside your container run this command
```bash
php artisan test
```
