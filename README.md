[![Build Status](https://travis-ci.org/Martin89PL/game-of-life-TDD.svg?branch=master)](https://travis-ci.org/Martin89PL/game-of-life-TDD)

Coding Dojo Silesia #6
======================

## Conway's Game of Life - PHP

Requires PHP 7.x

Instructions: http://codingdojo.org/kata/GameOfLife/  
Install: `php composer.phar install`  
Tests: `php composer.phar run-script test`  
Run: `php main.php input/glider.txt`


### Run using docker-compose
```docker-compose up```: download images and build  
```docker-compose run composer install```: installation dependencies from composer.lock 
```docker-compose run php ./vendor/bin/phpunit ./tests/```: run tests using docker-compose  
```docker-compose run php composer require <package_name>```: installation of package   