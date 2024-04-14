#!/bin/bash

set -e

cd /var/www/user

composer install

php bin/console doctrine:migrations:migrate

mysql -uroot -e "CREATE DATABASE IF NOT EXISTS microservice_test;"

mysql -uroot -e "INSERT INTO microservice_test.user SELECT * FROM microservice.user;"

exec "$@"