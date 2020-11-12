# Laravel + Lighthouse + GraphQL + CRUD + Passport Authentication

This boilerplate provides a simple and powerful start for your API.

It provides the following features:

Security
* Login
* Logout

Posts
* Create
* List
* Find
* Update
* Delete

The API is developed with the following packages:
* Laravel 8.14
* Lighthouse GraphQL
* Authentication using Passport

In addition, it is running on Docker.

## Prerequisites

You need to ensure that you have installed [Docker Composer](https://docs.docker.com/compose/install/) globally.

## Getting Started

### Download using Git

Clone the project from github. Change myproject to your project name.

```
git clone https://github.com/mateusgamba/laravel-lighthouse-graphql-crud-auth.git ./myproject --dissociate
```

### Configure your development environment

You must copy the `.env.example` file to a new file named `.env`.

```
cp .env.example .env
```

### Installing project

Access Project directory and run the following command:

```
docker-compose up -d
```

### Installing dependencies

```
docker-compose exec api composer install
```

### Build database - Running migrations

```
docker-compose exec api php artisan migrate
```

### Preloading data (optional)

```
php artisan db:seed
```

## Working with graphql

You can open GraphQL browser via the following link:

```
http://localhost:8000/graphql-playground
```

And run the following query:
```
{
    hello
}
```

The response will be:
```
{
    "data": {
        "hello": "it is working!"
    }
}
```

# Author

You can contact me directly on my Email (mateusgamba@gmail.com) or via Linkedin (https://www.linkedin.com/in/mateusgamba/).

Kind regards.