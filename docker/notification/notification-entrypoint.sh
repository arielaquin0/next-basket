#!/bin/bash

set -e

echo "Installing dependencies..."
composer install

echo "Running messenger consume..."
php bin/console messenger:consume async && php bin/console messenger:consume async -vv

exec "$@"