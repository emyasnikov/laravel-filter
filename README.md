# Laravel Filter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/intraset/laravel-filter.svg?style=flat)](https://packagist.org/packages/intraset/laravel-filter)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/intraset/laravel-filter.svg?style=flat)](https://packagist.org/packages/intraset/laravel-filter)

Filtering Eloquent queries based on HTTP requests.

## Installation

```bash
composer require intraset/laravel-filter
```

## Usage

To apply filters, e.g. on the user model, trait has to be used:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intraset\LaravelFilter\HasFilter;

class User extends Model
{
    use HasFilter;
}
```

Add filter class to your application to order users by name and filter using `?name=` parameter:

```php
<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Intraset\LaravelFilter\Filter;

class UserFilter extends Filter
{
    /**
     * Apply filters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder)
    {
        parent::apply($builder);

        $builder->orderBy('name');

        return $builder;
    }

    /**
     * Name filter.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name($value = null)
    {
        $this->builder->where('name', $value);

        return $this->builder;
    }
}
```

Filter class can then be used to simplify controllers index handler:

```php
public function index(Request $request, UserFilter $filter)
{
    $users = User::filter($filter)->get();

    return $users;
}
```

## Credits

- [Evgenij Myasnikov](https://github.com/emyasnikov)

I got the idea to filter HTTP requests by reading an [article](https://pineco.de/filtering-eloquent-queries-based-on-http-requests/) written by [D. Nagy Gergő](https://github.com/iamgergo) and used the code.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
