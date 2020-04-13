Time Zone Converter
------------------------ 

Convert times from different timezones to user timezone.

Built With
----------

Laravel 7

Requirements
------------

Php 7.4

Composer


Setup Guide
-----------

Clone this repo on your system and run 'composer install' from command line from project root directory.

Rename .env.example to .env and change configuration values as per requirements.

Run migrations by running command 'php artisan migrate' from project root.

Configure web server with public folder as document root and index.php as index file.


Running The Application
---------------------

This application possess following two pages

http(s)://yourdomain.com/, This page shows all available times in different timezones.

http(s)://yourdomain.com/converted, This page shows all available times converted to user specific timezone.


Testing
-------

To run all the tests run command vendor/bin/phpunit tests/ from root directory.


Code
-------

App/Domain is the folder that holds all the business logic.

CI/CD
-------

Building steps have been configured in Jenkinsfile
