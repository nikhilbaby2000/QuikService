<?php

namespace App\QuikService\Uuid;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait to auto set the UUID when creating a model object.
 * The trait by default sets the uuid to the model's primary key.
 * If you need to set the UUID value to another attribute then add a 'uuidAttributeName' property.
 *
 * @package App\Models\Traits
 */
trait UuidModel
{
    /**
     * Get the value indicating whether the IDs are incrementing.
     * Overwrite the method to always return false to disable auto incrementing as we are using UUID.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        if (empty($this->uuidAttributeName)) {
            return false;
        }

        return $this->uuidAttributeName !== $this->getKeyName();
    }

    /**
     * Binds creating event to insert an auto generated UUID.
     *
     * @return void
     */
    public static function bootUuidModel()
    {
        static::creating(function (Model $model) {
            $model->setAttribute($model->uuidAttributeName ?? $model->getKeyName(), uuid());
        });
    }
}
