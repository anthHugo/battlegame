run:
	chmod +x bin/console && bin/console game:run

install:
	composer install

test:
	php vendor/bin/phpunit --coverage-html var/coverage --coverage-xml=var/coverage-xml --log-junit=var/junit.xml

infection: test
	vendor/bin/infection --threads=4 --coverage=var/ --debug #--log-verbosity=all
	cat var/infection.log

coverage: infection
	xdg-open var/coverage/index.html

linter: phpcs phpstan

phpcs:
	vendor/bin/phpcs

phpstan:
	vendor/bin/phpstan analyse --ansi -c phpstan.neon

clean:
	rm -r var vendor .phpunit.result.cache
