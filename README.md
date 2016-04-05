# Yii-tripadvisor

[![Codeship Status for thewulf7/yii-tripadvisor](https://codeship.com/projects/5b96d6b0-dd45-0133-4b20-2682daabcfd0/status?branch=master)](https://codeship.com/projects/144335)

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