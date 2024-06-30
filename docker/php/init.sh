#!/usr/bin/env bash

cd /var/www/html

composer install

# Создать таблицы в базе данных
php bin/console doctrine:migrations:migrate --no-interaction

# Сгенерировать данные для теста
php bin/console app:load-quiz-data

php bin/console cache:clear

php-fpm
