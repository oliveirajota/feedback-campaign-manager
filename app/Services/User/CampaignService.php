<?php

namespace App\Services\User;


use App\Models\User\CampaignModel;
use App\Models\User\CollaboratorModel;
use App\User;

class CampaignService
{
    public function getCampaignById(string $id)
    {
        return CampaignModel::find($id);
    }

    public function getCollaboratorByUser(User $user)
    {
        $userId = $user->getId();
        return CollaboratorModel::where('user_id', '=', $userId)->first();
    }

    public function getUserDashboard(CollaboratorModel $collaborator)
    {
        return [
            'pendingCampaigns' => $collaborator->pendingCampaigns()->toArray()
        ];
    }

}