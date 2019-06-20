<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;

trait ModelBehavior
{
    public function getId()
    {
        return $this->id;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id= Uuid::uuid4();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

}