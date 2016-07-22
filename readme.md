## Intro

* 中文讨论请前往：https://phphub.org/topics/2301
* 中文教程见这里：https://phphub.org/topics/2407


Forked from [FrozenNode/Laravel-Administrator](https://github.com/FrozenNode/Laravel-Administrator) with the following changes:

* UI Improved
* UX Improved (Editor view stick, hover effect etc.)
* Model deletion with Sweet alert confirmation
* Batch model deletion
* Refresh btn
* Reduce page css and js file request number
* Edit view hint

> only intent to support Laravel 5.1.*

![1](https://cloud.githubusercontent.com/assets/324764/16544619/6db648d0-413f-11e6-8842-bf0b993416ef.png)

![2](https://cloud.githubusercontent.com/assets/324764/16544623/72a8c0ac-413f-11e6-9c5b-0259b07a7c37.png)

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
