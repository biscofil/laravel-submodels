# Laravel Submodels

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

UPGRADE TO V2: https://github.com/biscofil/laravel-submodels

Create submodels in Laravel

## Installation

Via Composer

``` bash
composer require biscofil/laravel-submodels
```

## Usage

``` php
>>> User::find(1)
=> App\AdminUser {#3182
     id: 1,
     first_name: "something",
     last_name: "something"
     is_admin: true,
     admin_parameter: "something"

>>> User::find(2)
=> App\User {#3164
     id: 2,
     first_name: "something",
     last_name: "something",
     is_admin: false
```

In order to accomplish this result, each Model that has to be extended must implement `getSubModelClass` that returns the right class depending on custom conditions.

``` php
class User extends Authenticatable{

    use SuperModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'is_admin'
    ];

    /**
    * @param $model
    * @return string|null
    */
   public function getSubModelClass($model){
       $class = null;
       if ($model->isAdmin()) {
           $class = AdminUser::class;
       } elseif ($model->isCustomer()) {
           $class = CustomerUser::class;
       }
       return $class;
   }

   /**
     * @param $query
     * @return mixed
     */
    public function scopeAdmins($query)
    {
        return $query->where('is_admin', '=', true);
    }

}
```

In order to have additional fillable fields just for a particular sub model, it must implement `getAppendedFillable` that returns the list of additional fillable parameters. When asking the fillable list, this array will be merged with the parent one.


``` php
class AdminUser extends User{

    use SubModel;

    public function newQuery()
    {
        return $this->scopeAdmins(parent::newQuery());
    }

    /**
     * @return array
     */
    public function getAppendedFillable()
    {
        return [
            'admin_parameter' // AdminUser has all the fillable fields inherited from the parent class User plus 'admin_parameter'
        ];
    }
}

```

## Credits

- [Filippo Bisconcin][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license) for more information.

[ico-version]: https://img.shields.io/packagist/v/biscofil/laravel-submodels.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/biscofil/laravel-submodels.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/biscofil/laravelsubmodels/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/biscofil/laravel-submodels
[link-downloads]: https://packagist.org/packages/biscofil/laravel-submodels
[link-travis]: https://travis-ci.org/biscofil/laravel-submodels
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/biscofil
[link-contributors]: ../../contributors
