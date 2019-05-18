<?php

namespace Biscofil\LaravelSubmodels;

trait SubModel
{

    /**
     * Get the fillable attributes for the model.
     *
     * @return array
     */
    public function getFillable()
    {
        return array_merge($this->getAppendedFillable(), parent::getFillable());
    }

    /**
     * @return array
     */
    public function getAppendedFillable(){
        return [];
    }

}