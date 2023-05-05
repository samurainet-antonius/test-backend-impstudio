# Users REST API

This service is built with PHP with Laravel.

## Requirements

- PHP Version 7.4.33+
- Other needed modules

## Modules Used

- Guzzle
- JWT
- Other

## Setup

Create `.env` file by copy from `.env.example`  

## Step running service

- migration and seed
```bash
php artisan migrate:refresh --seed
```

- run code (deafult port 8000)
```bash
php artisan serve
```

If you want to change the port, you can run the following command:
```bash
php artisan serve --port 3000
```


## Documentation API

```bash
BaseURL : localhost:8000/api
```

- Sign up
```bash
Endpoint {BaseURL}/auth/signup
```
```bash
Request { "username": "anton", "password": "password" }
```

- Login
```bash
Endpoint {BaseURL}/auth/login
```
```bash
Request { "username": "anton", "password": "password" }
```

- User list
```bash
Endpoint {BaseURL}/user/userlist
```
```bash
Request { "limit": "1", "limit": "10" }
```
