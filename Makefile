run:
	chmod +x bin/console && bin/console game:run

install:
	composer install

test:
	php vendor/bin/phpunit

coverage:
	php vendor/bin/phpunit --coverage-html var/coverage --coverage-xml=var/coverage-xml --log-junit=var/junit.xml && xdg-open var/coverage/index.html;

infection: coverage
	vendor/bin/infection --threads=4 --coverage=var/ --debug #--log-verbosity=all

clean:
	rm -r var vendor