[![Build Status](https://travis-ci.org/Martin89PL/game-of-life-TDD.svg?branch=master)](https://travis-ci.org/Martin89PL/game-of-life-TDD)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Martin89PL/game-of-life-TDD/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Martin89PL/game-of-life-TDD/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/Martin89PL/game-of-life-TDD/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

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
### Check code style tools
`php ./vendor/bin/phpcs --standard=PSR2 ./src`  
`php ./vendor/bin/phpcs --standard=PSR1 ./src`  
`php ./vendor/bin/phpstan analyse src --level max`    