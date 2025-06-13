.PHONY: install test phpstan docker-build docker-up docker-down

install:
   composer install

test:
   vendor/bin/phpunit  

phpstan:
  vendor/bin/phpstan analyse

docker-build:
   docker-compose build

docker-up:
   docker-compose up -d

docker-down:
   docker-compose down

docker-test:
   docker-compose exec php vendor/bin/phpunit

docker-phpstan:
   docker-compose exec php vendor/bin/phpstan analyse

all-tests: test phpstan

docker-all-tests: docker-test docker-phpstan