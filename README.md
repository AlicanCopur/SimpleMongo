# SimpleMongo

SimpleMongo is a simple API for MongoDB, written in PHP.

### How to use?
First of all, copy SimpleMongo.php into your project and fill the first 5 variables (host, port, username, password, dbName)
Then initialize the SimpleMongo.

### Initializing
```php
require('SimpleMongo.php');
SimpleMongo::init();
```
## All Methods
| Method | Description | Return |
|:-----------:|:----------:|:----------:|
| getAll($collection) | Returns all data in the collection. | array |
| get($collection, $queryKey, $queryValue, $key) | Returns the result of $key, looking at the values of $queryKey and $queryValue. | string/null |
| exists($collection, $key, $value) | Tells whether the value of the $key column is $value.  | bool |
| remove($collection, $key, $value) | Removes the entire document whose $key is $value.  | void |
| add($collection, $array) | Adds new document into the collection. | void |
| update($collection, $queryKey, $queryValue, $key, $value) | Sets $key to $value in the document whose $queryKey and $queryValue values match.  | void |

### Examples
```php
<?php
require('SimpleMongo.php');

SimpleMongo::init();

SimpleMongo::add("users", 
    [
        "username" => "AlicanCopur", 
        "password" => "12345"
    ]
);
```

### Contributing and issues
We welcome contributions and you can create an issue to report bugs.