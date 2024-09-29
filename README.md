# Laravel UserList Handler

Пакет который обрабатывает строки различных форматов.
Опционально поддерживает интеграцию с Laravel.

## Минимальные требования

- PHP 8.2
- Laravel 11.0 и выше

## Установка
```sh
composer require suddhah/userlist-handler
```

## Использование

##### Доступны три реализации парсера:

Каждая из которых возвращает массив с обработанными данными, либо EmptyDataException / InvalidFormatException

JSON: `Suddhah\UserListHandler\Parsers\JsonParser`

CSV: `Suddhah\UserListHandler\Parsers\CsvParser`

XML: `Suddhah\UserListHandler\Parsers\XmlParser`

##### Пример использования:
```php
// Данные для парсинга
$data = '...';

// Создаем реестр с парсерами
$parserRegistry = ParserFactory::createParserRegistry();

// Создаем экземпляр парсера, передаем ему экземпляр детектора для проверки формата строки
$userListHandler = new UserListHandler($parserRegistry);

// Запускаем парсер
// 1. Если нужно явно указать тип строки, можно передать константу (TYPE_JSON, TYPE_CSV, TYPE_XML)
$result = $userListHandler->run($data, UserListHandler::TYPE_CSV);
// 2. Если имеется доступ к имени файла, можно воспользоваться хелпером detect_type_by_name()
$result = $userListHandler->run($data, detect_type_by_name($filename));
```
##### Пример использования в контексте Laravel через фасад UserListFacade:
```php
UserListFacade::run($data, UserlistHandler::TYPE_JSON);
````

##### Пример входящих данных
```json
{
  "users": [
    {
      "id": 1,
      "name": "Иван Петров",
      "email": "ivan@example.com",
      "age": 30
    },
    ...
  ]
}
```
```csv
id,name,email,age
1,Иван Петров,ivan@example.com,30
2,Мария Сидорова,maria@example.com,25
3,Алексей Иванов,alexey@example.com,35
```
```xml
<?xml version="1.0" encoding="UTF-8"?>
<users>
    <user>
        <id>1</id>
        <name>Иван Петров</name>
        <email>ivan@example.com</email>
        <age>30</age>
    </user>
    ...
</users>
```
##### Возвращаемые данные:
```php
array:3 [
  0 => array:4 [
    "id" => 1
    "name" => "Иван Петров"
    "email" => "ivan@example.com"
    "age" => 30
  ]
  1 => array:4 [
    "id" => 2
    "name" => "Мария Сидорова"
    "email" => "maria@example.com"
    "age" => 25
  ]
  2 => array:4 [
    "id" => 3
    "name" => "Алексей Иванов"
    "email" => "alexey@example.com"
    "age" => 35
  ]
]
```

## Расширение своими реализациями:
- Создать свою реализацию интерфейса ParserInterface в директории Parsers.
```php
class YamlParser implements ParserInterface
{
    public function parse(string $data): array
    {
        // Логика для парсинга YAML
    }
}
```
- Регистрация нового парсера.
```php
ParserFactory::registerParser('yaml', new YamlParser());
```
- Вызов нового парсера.
```php
// 1. Если нужно явно указать тип строки, передать установленное ранее значение для типа в ParserFactory::registerParser()
$result = $userListHandler->run($data, 'yaml');
// 2. Если имеется доступ к имени файла, можно воспользоваться хелпером detect_type_by_name()
$result = $userListHandler->run($data, detect_type_by_name($filename));
```

## Тестирование

Выполнить команду `composer install --dev`, а затем запустить одну из следующих команду из корня данного пакета:

```shell
composer test
```

## PHP CS Fixer

Используется [PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) 
для автоматического форматирования кода согласно стандартам PHP.
```shell
composer lint
```

## Соблюдаемые принципы
    S - Single Responsibility Principle: Каждый класс отвечает за свою единственную задачу — парсинг конкретного формата.
    O - Open/Closed Principle: Новые парсеры могут быть добавлены без изменения существующих.
    L - Liskov Substitution Principle: Все парсеры реализуют единый интерфейс и могут использоваться взаимозаменяемо.
    I - Interface Segregation Principle: Интерфейс имеет всего один метод, что позволяет избежать ненужных зависимостей.
    D - Dependency Inversion Principle: Класс UserListHandler зависит от абстракций (интерфейсов), а не от конкретных реализаций.
