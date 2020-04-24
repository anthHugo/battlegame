run:
	chmod +x bin/console && bin/console game:run

install:
	composer install

test:
	php vendor/bin/phpunit

coverage:
	php vendor/bin/phpunit --coverage-html var/phpunit/coverage --coverage-xml=var/infection/coverage/coverage-xml --log-junit=var/infection/coverage/junit.xml && xdg-open var/phpunit/coverage/index.html;

infection: coverage
	vendor/bin/infection --coverage=var/infection/coverage --debug

clean:
	rm -r var vendor