<?php

namespace App\Models\Admin;

use App\Models\ModelBehavior;
use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    use ModelBehavior;

    protected $table = 'company';

    protected $fillable = ['name', 'user_id'];
}