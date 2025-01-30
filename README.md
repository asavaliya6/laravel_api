## Laravel API

<h3>Step 1: Install Laravel 11</h3>

```
composer create-project laravel/laravel example-app
```

<h3>Step 2: Enable API and Update Authentication Exception</h3>

```
php artisan install:api
```

<h3>Step 3: Install and Setup JWT Auth package</h3>

- install php-open-source-saver/jwt-auth composer package: 

```
composer require php-open-source-saver/jwt-auth
```

- publish the package config file:

```
php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
```

- generate a secret key.this will add JWT config values on .env file:

```
php artisan jwt:secret
```

<h3>Step 4: Update User Model</h3>

- implement first the Tymon\JWTAuth\Contracts\JWTSubject contract on the User Model and implement the getJWTIdentifier() and getJWTCustomClaims() methods.

<h3>Step 5: Create API Routes</h3>

- create API routes in ```routes/api.php```

<h3>Step 6: Create Controller Files</h3>

- create a new folder name "API" in the Controllers folder and create a new controller BaseController and AuthController inside the API folder.

<h3>Step 7: Run Laravel App</h3>

```
php artisan serve
```

<h3>Step 8: API Check</h3>

1) Register API: Verb:POST, URL:http://localhost:8000/api/auth/register
2) Login API: Verb:POST, URL:http://localhost:8000/api/auth/login
3) Profile API: Verb:POST, URL:http://localhost:8000/api/auth/profile
4) Refresh API: Verb:POST, URL:http://localhost:8000/api/auth/refresh
5) Logout API: Verb:POST, URL:http://localhost:8000/api/auth/logout
