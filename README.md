# Yii-tripadvisor

### Installation

Begin by installing this package through Composer.

```js
{
    "require": {
        "thewulf7/yii-tripadvisor": "dev-master"
    }
}
```

```php
    'components' => [
        ...
        'tripadvisor' => [
            'class' => 'thewulf7\tripadvisor\Connection'
        ]
        ...
    ]
```

### Usage

**Retrieve data**

```php
$wiki = \Yii::$app->get('tripadvisor');
    
return $wiki->createCommand()->search('Moscow');
```

**Same with QueryBuilder**

```php
$query = new \thewulf7\tripadvisor\Query();

$query
    ->titles('Moscow');

return $query
    ->createCommand()
    ->search();
```

**More examples in tests forlder**