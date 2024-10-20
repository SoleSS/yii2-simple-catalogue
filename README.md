# yii2-simple-catalogue

## Installation

composer require --prefer-dist soless/yii2-simple-catalogue "*"

php yii migrate/up --migrationPath=@vendor/soless/yii2-simple-catalogue/migrations

add to config:
```
    'modules' => [
        'catalogue' => [
            'class' => '\soless\catalogue\Module',
        ]
    ],
```

## Available CRUD controllers:

catalogue/item

catalogue/category

catalogue/tag