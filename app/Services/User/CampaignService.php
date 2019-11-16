<?php

namespace App\Services\User;


use App\Models\User\CampaignAnswerModel;
use App\Models\User\CampaignCollaboratorAnswerModel;
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

    public function saveAnswers(array $data, string $campaignId)
    {
        $answerData = $this->mountAnswerData($data);

        foreach ($answerData as $answerItem) {
            $answer = CampaignAnswerModel::find($answerItem['id']);
            $answer->result = $answerItem['result'];
            $answer->comment = $answerItem['comment'];
            $answer->save();
        }
    }

    private function mountAnswerData(array $data)
    {
        $answerData = [];
        foreach ($data['id'] as $answerId){
            $answerData[$answerId]['id'] = $answerId;
            $answerData[$answerId]['result'] = $data['result'][$answerId];
            $answerData[$answerId]['comment'] = $data['comment'][$answerId];
        }

        return $answerData;
    }

    public function saveCollaboratorAnswers(array $data, string $campaignId)
    {
        $answerData = $this->mountAnswerData($data);

        foreach ($answerData as $answerItem) {
            $answer = CampaignCollaboratorAnswerModel::find($answerItem['id']);
            $answer->result = $answerItem['result'];
            $answer->comment = $answerItem['comment'];
            $answer->save();
        }
    }

    public function getCollaboratorInfo(string $collaboratorId)
    {
        $collaborator = CollaboratorModel::find($collaboratorId);
        return $collaborator->toArray();
    }


}