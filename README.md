# Laravel Filter

Filtering Eloquent queries based on HTTP requests.

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

use Intraset\LaravelFilter\Filter;
use Illuminate\Database\Eloquent\Builder;

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
    $users = User::filter($filter)
        ->get();

    return $users;
}
```
