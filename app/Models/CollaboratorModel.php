<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorModel extends Model
{
    use ModelBehavior;

    protected $table = 'collaborator';
    protected $fillable = ['uuid', 'owner_id', 'user_id', 'name'];
}