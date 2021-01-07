# Laravel + Lighthouse + GraphQL + CRUD + Passport Authentication

This boilerplate provides a simple and powerful start for your API.

Try out the [Demo](https://laravel-lighthouse.herokuapp.com/graphql-playground).

![](https://repository-images.githubusercontent.com/311953168/2f47fe00-3621-11eb-8e2b-a6f67e7cb8f3)

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
* Laravel (8.20.1v)
* Lighthouse GraphQL (4.8v)
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
php artisan passport:client --password --provider=users --name=boilerplate
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

mutation {
  refreshToken(
    refresh_token: "def50200c767e126a49b1..."
  ) {
    access_token
    refresh_token
    token_type
    expires_in
  }
}

mutation {
  logout {
    message
  }
}
```

### User

```graphql
mutation {
  createUser(
    name: "John Doe"
    email: "johndoe@christmas.com"
    password: "123123"
    password_confirmation: "123123"
  ) {
    message
  }
}

mutation {
  updateUser(
      id: 2
      fields: {
        name: "John Doe"
        email: "johndoe@christmas.net"
        password: "123456"
        password_confirmation: "123456"
      }
  ) {
    id
    name
    email
  }
}

```

### Post Mutation

The Post Mutation needs Authentication, you must add Bearer Authentication to Header.

```
{
  "Authorization": "Bearer {Enter the token generated here}"
}
```

```graphql
"""
Create a new Post
"""
mutation {
  createPost(title: "Hello", content: "Hello World") {
    id
    title
    content
    createdby {
      id
      name
    }
    updatedby {
      id
      name
    }
  }
}

"""
Update an existing Post
"""
mutation {
  updatePost(id: 1, post: { title: "Working", content: "It's working" }) {
    id
    title
    content
    createdby {
      id
      name
    }
    updatedby {
      id
      name
    }
  }
}

"""
Delete a Post
"""
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
  posts(filter: { content: "%soluta%" }) {
    data {
        id
        title
        content
        comments {
            id
            name
            email
            content
        }
        createdby {
            id
            name
        }
        updatedby {
            id
            name
        }
    }
    paginatorInfo {
      count
      currentPage
      firstItem
      hasMorePages
      lastItem
      lastPage
      perPage
      total
    }
}

"""
Find post
"""
{
  post(id: 1) {
    id
    title
    content
    comments {
      id
      name
      email
      content
    }
    createdby {
        id
        name
    }
    updatedby {
        id
        name
    }
  }
}
```

### Comment Mutation

```graphql
"""
Create a new Post
"""
mutation {
  createComment(
    name: "John Doe"
    email: "hello@helloworld.com"
    content: "Hello World!"
    post_id: 2
  ) {
    id
    name
    email
    content
  }
}

"""
Delete a Comment
"""
mutation {
  deleteComment(id: 2) {
    message
  }
}
```

# Author

You can contact me directly on my Email (mateusgamba@gmail.com) or via Linkedin (https://www.linkedin.com/in/mateusgamba/).

Kind regards.
