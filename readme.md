# LaravelSubmodels

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

Create submodels in Laravel

## Installation

Via Composer

``` bash
$ composer require biscofil/laravelsubmodels
```

## Usage

``` php
<?php

class User extends Authenticatable{

    use SuperModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name'
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

}

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
            'admin_parameter'
        ];
    }
}

```

## Credits

- [Filippo Bisconcin][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/biscofil/laravelsubmodels.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/biscofil/laravelsubmodels.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/biscofil/laravelsubmodels/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/biscofil/laravelsubmodels
[link-downloads]: https://packagist.org/packages/biscofil/laravelsubmodels
[link-travis]: https://travis-ci.org/biscofil/laravelsubmodels
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/biscofil
[link-contributors]: ../../contributors
