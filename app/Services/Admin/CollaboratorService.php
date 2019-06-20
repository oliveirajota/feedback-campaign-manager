<?php

namespace App\Services\Admin;

use App\Models\Admin\CollaboratorModel;

class CollaboratorService
{
    public function getCollaborators()
    {
        return CollaboratorModel::all()->toArray();
    }

}