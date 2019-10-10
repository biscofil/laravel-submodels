<?php

namespace Biscofil\LaravelSubmodels\Test;


use Biscofil\LaravelSubmodels\HasSubModels;
use Illuminate\Database\Eloquent\Model;

/**
 * @property bool is_admin
 */
class BaseUser extends Model
{
    use HasSubModels;

    protected $fillable = [
        'is_admin'
    ];

    protected $casts = [
        'is_admin' => 'bool'
    ];

    /**
     * @param $model
     * @return string
     */
    public function getSubModelClass($model)
    {
        /** @var BaseUser $model */
        if ($model->isAdmin()) {
            return AdminUser::class;
        } else {
            return CustomerUser::class;
        }
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function operation(){
        return "base";
    }


    public function getData()
    {
        return array_merge(['base'], []);
    }
}