# Сервис  Balance

#### Назначение

Этот сервис предназначен для получения, информации о текущем балансе и о транзакциях пользователей

#### Принцип работы и взаимосвязь с другими сервисами

Поддерживает приём запросов в формате `jsonrpc`

```curl
 curl 'http://localhost' --data-binary '{"jsonrpc": "2.0", "method": "method_name", "params": {"param1": "hello", "param2": 567}, "id": 1}'
```

На данный момент поддерживает только два метода
- получение текущего баланса пользователя ``` curl 'http://localhost' --data-binary '{"jsonrpc": "2.0", "method": "balance.history", "params": {"user_id": int, "limit": int, "id": 1}'```
- получение последних N транзакций пользователя ``` curl 'http://localhost' --data-binary '{"jsonrpc": "2.0", "method": "balance.userBalance", "params": {"user_id": int}, "id": 2}'```

#### Способ запуска/разворачивания

После скачивания приложения через `git pull` необходимо в директории проекта выполнить следующие команды
- `composer install` - для установления зависимостей
- для тестовой среды необходимо выполнить `docker-compose up -d --build` (поднимаем базу данных `mysql`)
- для создания таблиц нужно выполнить `php artisan migrate` и для их наполнения `php artisan db:seed --class=BalanceHistorySeeder`
- после выполняем `php artisan serve`


После всех этих действий на порте 8000 доступен сервис, и можно уже делать запросы к нему.
Примеры запросов 


```

curl 'http://127.0.0.1:8000/api/v1/balance' --data-binary '{"jsonrpc": "2.0", "method": "balance.history", "params": {"user_id": 1, "limit": 4}, "id": 1}'
curl 'http://127.0.0.1:8000/api/v1/balance' --data-binary '{"jsonrpc": "2.0", "method": "balance.userBalance", "params": {"user_id": 1}, "id": 2}'

```
