<?php

namespace Biscofil\LaravelSubmodels\Tests\Models;

use Biscofil\LaravelSubmodels\HasSubModels;
use Illuminate\Database\Eloquent\Model;

/**
 * @property bool is_admin
 * @property mixed id
 */
class BaseUser extends Model
{
    use HasSubModels;

    public $timestamps = false;

    protected $table = 'users';

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

}