<?php

namespace Biscofil\LaravelSubmodels;

trait HasAppendedFields
{

    /**
     * Get the fillable attributes for the model.
     * @return array
     */
    public function getFillable()
    {
        $appendedFillable = property_exists($this, 'appendedFillable') ? $this->appendedFillable : [];
        return array_unique(array_merge($appendedFillable, parent::getFillable()));
    }

    /**
     * Get the attributes for the model.
     * @return array
     */
    public function getAttributes()
    {
        $appendedAttributes = property_exists($this, 'appendedAttributes') ? $this->appendedAttributes : [];
        return array_unique(array_merge($appendedAttributes, parent::getAttributes()));
    }

    /**
     * Get the casted attributes for the model.
     * @return array
     */
    public function getCasts()
    {
        $appendedCasts = property_exists($this, 'appendedCasts') ? $this->appendedCasts : [];
        return array_unique(array_merge($appendedCasts, parent::getCasts()));
    }


}