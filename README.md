# Тест с вопросами c нечёткой логикой для тестового задания

## Как запустить
1. Перейти в папку с проектом
2. Поднять контейнеры
```
docker-compose up -d
```
3. Установить зависимости
```
docker-compose exec php composer install
```
4. Создать таблицы в базе данных
```
docker-compose exec php php bin/console doctrine:migrations:migrate --no-interaction
```
5. Импортировать вопросы в базу данных
```
docker-compose exec php php bin/console app:load-quiz-data
```