#user
[![Build Status](https://travis-ci.org/chimerarocks/user.svg?branch=master)](https://travis-ci.org/chimerarocks/user)

#Installation
###1. Install package

```
composer require chimerarocks/user
```

###2. Add provider

#####in config/app.php

```php
'providers' => [
    ...
    ChimeraRocks\User\Providers\UserServiceProvider::class,
],
```

###3. Publish views and migrations
>remove old users migrations!

```
php artisan vendor:publish
```

###4. Refactoring User
1. remove app/User.php
2. change App\User class in all class of App\Controllers\Auth to ChimeraRocks\User\Models\User

###5. Change users provider

####config/auth.php

```php
'providers' => [
   'users' => [
       'driver' => 'eloquent',
       'model' => \ChimeraRocks\User\Models\User::class,
   ],
],
```
###6. Add the middleware
####on kernel.php

```php
$routeMiddleware = [
    ...
    'authorization' => ChimeraRocks\User\Middlewares\Authorization
]
```

###7. Add the routes
####on web.php

```php
App::make('chimerarocks_user_route')->auth();
```

###8. Generate schema
```
php artisan migrate
```

###9. Install Passport
```
php artisan passport:install
```
