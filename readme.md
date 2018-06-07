#Install instructions for Club99

Git clone ```https://bitbucket.org/team0099/club99.git```



Install PHP Composer: https://getcomposer.org/doc/00-intro.md#installation-windows



Change directory to <local>

Run in terminal/cmd ```composer install```

Run in terminal/cmd ```composer dumpautoload```



Create a database



Set ```.env``` file for database connection. For this you must create ```.env``` file if not created. Just copy content from ```.env.example``` into .env file. 


Run in terminal/cmd:
```php artisan key:generate```
 ```php artisan migrate --seed```
```php artisan notifynder:create:category "notifications" "notifications"```


For development and testing run command (your path may differ):  ```sudo chmod +777 -R /var/www/html/club99/storage ```
For online deployment:
1) create user www-data for the webserver
2) sudo  ```chown -R www-data:www-data /var/www/html/club99/storage```

In browser navigate to ```localhost/club99/public```



# Club99 project structure and folder guide
\app\ database objects and the relationships between them

\app\PaymentGateways pay1 integration

\app\Http\routes.php Laravel routes

\app\Http\Controllers Laravel controllers

\app\Http\Middleware Laravel Middleware, exceptions to the routes in given situations. For example when the membership expires go to subscription choice view.
\resources\views every frontend page(view, GUI) in the website

\public\assets\dist front end styling

\public\assets\plugins front end plugins

\public base folder of the front end website and root of the index


# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).