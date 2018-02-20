#!/bin/bash

echo "----> Updating composer"
composer -V
composer self-update
echo "----> Done"

if [ $# -ne 2 ]; then
    echo "----> Must define environment"
    exit 1
fi

if [ "$1" == "dev" ]; then
echo "----> Setting up testing environment"
echo "----> copying .env.testing.$2 to .env"
echo "----> Running composer install"
composer install --no-ansi --no-interaction --no-progress --no-scripts
echo "----> Done"
fi

if [ "$1" == "prod" ]; then
echo "----> Setting up production environment"
echo "----> Running composer install"
composer install --no-ansi --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader
echo "----> Done"
fi