# JTL - Containerised PHP Skeleton Project 


## How-To-Start

* Checkout
* install dependencies `./composer install`
* run tests `./vendor/bin/phpunit`
* ensure code style `./composer phpcs`
* start container `docker-compose up -d`
* visit `http://localhost:8011`
* Happy Coding!

## Directories

* `./src` - This is where your OOP Model must be located.
* `./public` - Here you must store all public accessible resources.
* `./tests` - We all love Tests! This may be the best location for it.
* `./build` - PHPUnit drop all code coverage reports to this directory.
* `./contrib` - This package is self-contained and even composer.phar is located in here.
* `./docker` - Dockerfile(s) must be located here.
