<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    use ModelBehavior;

    protected $table = 'base_question';
    protected $fillable = ['question', 'description', 'type'];
}