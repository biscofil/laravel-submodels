<?php

namespace Biscofil\LaravelSubmodels;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasSubModels
{

    /**
     * Create a new model instance that is existing.
     *
     * @param array $attributes
     * @param string|null $connection
     * @return static
     */
    public function newFromBuilder($attributes = [], $connection = null)
    {

        /** @var Model $model */
        $model = $this->newInstance([], true);

        $model->setRawAttributes((array)$attributes, true);

        $class = null;
        if (__CLASS__ === get_called_class()) {
            $class = $this->getSubModelClass($model);
        }

        if (!is_null($class)) {
            $model = with(new $class)->newFromBuilder($attributes);
        } else {
            $model->setConnection($connection ?: $this->getConnectionName());
            $model->fireModelEvent('retrieved', false);
        }

        return $model;
    }

    /**
     * @param $model
     */
    public abstract function getSubModelClass($model);

    /**
     * @param array $attributes
     * @return Builder|Model|null
     */
    public static function create(array $attributes = [])
    {
        $model = static::query()->create($attributes);
        return $model->fresh();
    }


}
