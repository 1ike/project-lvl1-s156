install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR2 src bin

fix:
	composer run-script phpcbf -- --standard=PSR2 src bin
