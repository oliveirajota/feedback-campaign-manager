<?php

namespace App\Models;


use Illuminate\Support\Str;
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
            $model->uuid = Uuid::uuid4();
        });
    }

}