<?php

namespace App\Models\Traits;

trait HasPaddedId
{
    /**
     * Get padded attribute value.
     *
     * @return string
     */
    public function getPaddedIdAttribute()
    {
        $id = isset($this->padded_attribute) ? $this->{$this->padded_attribute} : $this->id;

        return sprintf('%07u', $id);
    }
}