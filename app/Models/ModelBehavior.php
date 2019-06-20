<?php

namespace App\Models;


trait ModelBehavior
{
    public function getId()
    {
        return $this->id;
    }
}