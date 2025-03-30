# Тестовое задание в Hantico

Запустить проект можно командой
```
docker compose up -d --build
```
и на [http://localhost:8080](http://localhost:8080) запуститься проект

Попасть в контейнер с PHP можно следующей командой
```
docker exec -it app bash
```
Теперь нужно установить зависимости командой 
```
composer install
```
И создать ключ для Laravel
```
php artisan key:generate
```
Теперь можете запустить миграции с сидерами командой 
```
php artisan migrate:fresh --seed
```
**Чтобы открыть Swagger нужно перейти на [http://localhost:8081/](http://localhost:8081/)**
Чтобы выполнить тесты вы должны в PHP контейнере выполнить команду 
```
php artisan test
```