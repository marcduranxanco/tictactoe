install:
	docker-compose run --rm composer install

up:
	docker-compose up -d

down:
	docker-compose down

dump:
	docker-compose run --rm composer -- dump

dumpo:
	docker-compose run --rm composer dump -o

composer:
	docker-compose run --rm composer bash

php:
	docker-compose run --rm php bash

run-tests:
	docker-compose run --rm phpunit tests

play:
	docker-compose run --rm php php bin/console.php tictactoe