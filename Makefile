run:
	chmod +x bin/console && bin/console game:run

install:
	composer install

test:
	php vendor/bin/phpunit --coverage-html var/coverage --coverage-xml=var/coverage-xml --log-junit=var/junit.xml

infection:
	vendor/bin/infection --threads=4 --coverage=var/ --log-verbosity=all

coverage: test infection
	xdg-open var/coverage/index.html

linter: phpcs phpstan

phpstan:
	vendor/bin/phpstan analyse --ansi -c phpstan.neon

phpcs:
	vendor/bin/phpcs

clean:
	rm -r var vendor