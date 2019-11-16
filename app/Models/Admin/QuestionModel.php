<?php

namespace App\Models\Admin;

use App\Models\ModelBehavior;
use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    use ModelBehavior;

    protected $table = 'base_question';
    protected $fillable = ['question', 'description', 'type', 'owner_id'];
}