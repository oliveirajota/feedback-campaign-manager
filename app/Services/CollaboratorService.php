<?php

namespace App\Services;


use App\Models\CollaboratorModel;

class CollaboratorService
{
    public function getCollaborators()
    {
        return CollaboratorModel::all()->toArray();
    }

}