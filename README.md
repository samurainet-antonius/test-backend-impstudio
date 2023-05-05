# Users REST API

This service is built with PHP with Laravel.

## Requirements

- PHP Version 7.4.33+
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- DBMS MySQL
- Composer
- Other needed modules

## Modules Used

- Guzzle
- JWT
- Other

## Setup

Create `.env` file by copy from `.env.example`  
Download vendor/modules, you can run command  `composer install`

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
Request { "limit": "10", "page": "1" }
Header Authorization : Bearer {token}
```
