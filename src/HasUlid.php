<?php

namespace Rorecek\Ulid;

trait HasUlid
{
    protected static function bootHasUlid()
    {
        static::saving(function ($model) {
            $originalUlid = $model->getOriginal('id');
            if ($originalUlid && $originalUlid !== $model->id) {
                $model->id = $originalUlid;
            } else if (!$model->id && !$originalUlid) {
                $model->id = \Ulid::generate();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the primary key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}
