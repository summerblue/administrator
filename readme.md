## Intro

中文讨论请前往：https://phphub.org/topics/2301

Forked from [FrozenNode/Laravel-Administrator](https://github.com/FrozenNode/Laravel-Administrator) with the following changes:

* UI Improved
* UX Improved (Editor view stick, hover effect etc.)
* Model deletion with Sweet alert confirmation
* Batch model deletion
* Refresh btn
* Reduce page css and js file request number

> only intent to support Laravel 5.1.*

![image](https://cloud.githubusercontent.com/assets/324764/16544335/da35e066-4134-11e6-8a40-db2ad9753a4f.png)

![image](https://cloud.githubusercontent.com/assets/324764/16544336/e7e1a02e-4134-11e6-8dc0-f63ad57a5d14.png)

## Install

### 1. composer require

```
composer require "summerblue/administrator:^1.0"
```

### 2. add provider

Edit `config/app.php` in `providers` array add provider:

```php
'providers' => [
	Frozennode\Administrator\AdministratorServiceProvider::class,
]
```

### 3. publish assets/config

```
php artisan vendor:publish
```

Read the docs: http://administrator.frozennode.com

-- end