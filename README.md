# Laravel + Lighthouse + GraphQL + CRUD + Passport Authentication

This boilerplate provides a simple and powerful start for your API.

Try out the [Demo](https://laravel-lighthouse.herokuapp.com/graphql-playground).

It provides the following features:

* CRUD (create / read / update / delete) on posts
* Creating comments on post page
* Pagination on posts listing
* Searching on posts
* Authentication (login / logout / refresh token)
* Creating user account
* Update user profile and changing password
* Application ready for production

The API is developed with the following packages:
* Laravel 8.14
* Lighthouse GraphQL
* Authentication using Passport

In addition, it is running on Docker.

## Pre-requisites

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

### Generates the encryption keys

```
php artisan passport:install --force
```

## Testing Graphql

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

## Schemas

### Authentication

```graphql
mutation {
  login(email: "noel@christmas.com", password: "password") {
    access_token
    refresh_token
    token_type
    expires_in
  }
}

"""
To get a new token you must add refresh-token parameter to HTTP Headers.

{
  "refresh-token": "{RefreshToken}"
}
"""
mutation {
  refresh {
    access_token
    refresh_token
    token_type
    expires_in
  }
}

```
### Post Mutation

The Post Mutation needs Authentication, you must add Bearer Authentication to Header.

```
{
  "Authorization": "Bearer __TOKEN__"
}
```

```graphql
mutation {
  createPost(title: "Hello", content: "Hello World") {
    id
    title
    content
    user {
      id
      name
    }
  }
}

mutation {
  updatePost(id: 1, post: { title: "Working", content: "It's working" }) {
    id
    title
    content
    user {
      id
      name
    }
  }
}

mutation {
  deletePost(id: 1) {
    message
  }
}
```

### Post Query
```graphql
"""
List all post
"""
{
  posts {
    id
    title
    user {
      id
      name
    }
  }
}

"""
Find post
"""
{
  post(id: 1) {
    id
    title
    user {
      id
      name
    }
  }
}
```

# Author

You can contact me directly on my Email (mateusgamba@gmail.com) or via Linkedin (https://www.linkedin.com/in/mateusgamba/).

Kind regards.