# Тест с вопросами c нечёткой логикой для тестового задания

## Как запустить
1. Склонировать репозиторий
```
git clone https://github.com/DmitriiTz/Quiz-Test.git
```
2. Перейти в папку с проектом 
```
cd Quiz-Test
```
3. Поднять контейнеры
```
docker-compose up -d
```
4. Установить зависимости
```
docker-compose exec php composer install
```
5. Создать таблицы в базе данных
```
docker-compose exec php php bin/console doctrine:migrations:migrate --no-interaction
```
6. Импортировать вопросы в базу данных
```
docker-compose exec php php bin/console app:load-quiz-data
```
7. Открыть сайт http://localhost:80