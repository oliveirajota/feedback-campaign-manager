<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    use ModelBehavior;

    protected $table = 'company';

    protected $fillable = ['uuid', 'name', 'user_id'];
}