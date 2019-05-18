<?php

namespace App;

trait SuperModel
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


}