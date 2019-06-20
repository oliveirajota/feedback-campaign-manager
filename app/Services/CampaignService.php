<?php

namespace App\Services;

use App\Models\CampaignAnswerModel;
use App\Models\CampaignCollaboratorAnswerModel;
use App\Models\CampaignCollaboratorModel;
use App\Models\CampaignModel;
use App\Models\CampaignQuestionModel;
use App\Models\CollaboratorModel;
use App\Models\QuestionModel;
use App\User;
use Carbon\Carbon;

class CampaignService
{

    public function getCampaignsObj()
    {
        return CampaignModel::all();
    }

    public function getCampaigns()
    {
        return $this->getCampaignsObj()->toArray();
    }

    public function getCampaignsWithCollaborators()
    {
        $campaigns = $this->getCampaignsObj();
        $campaignsArray = [];

        foreach ($campaigns as $campaign) {
            $campaignsArray[$campaign->getId()] = $campaign->toArray();
            $campaignsArray[$campaign->getId()]['collaborators'] = $campaign->collaborators()->get()->toArray();
        }

        return $campaignsArray;
    }

    public function getCampaign(string $id)
    {
        return CampaignModel::find($id);
    }

    public function createCampaign(array $data, User $user)
    {
        $data['owner_id'] = $user->getId();
        $data['start_at'] = new Carbon($data['start_at']);
        $data['expire_at'] = new Carbon($data['expire_at']);
        $campaign = new CampaignModel($data);
        return $campaign->save();
    }

    public function addQuestion(CampaignModel $campaign, string $questionId)
    {
        $question = QuestionModel::find($questionId);

        if (!$question) {
            return false;
        }

        $questionData = $question->toArray();
        $questionData['campaign_id'] = $campaign->getId();

        $campaignQuestion = new CampaignQuestionModel($questionData);
        return $campaign->questions()->updateOrCreate($campaignQuestion->toArray());
    }

    public function addCollaborator(CampaignModel $campaign, string $collaboratorId)
    {
        $collaborator = CollaboratorModel::find($collaboratorId);

        if (!$collaborator) {
            return false;
        }

        $collaboratorData['campaign_id'] = $campaign->getId();
        $collaboratorData['collaborator_id'] = $collaborator->getId();
        $collaboratorData['status'] = 'pending';

        return $campaign->collaborators()->updateOrCreate($collaboratorData);
    }

    public function publish(string $campaignId)
    {
        $campaign = $this->getCampaign($campaignId);

        $campaignCollaborators = $campaign->collaborators()->get();


        foreach ($campaignCollaborators as $campaignCollaborator){
        $collaborator = $campaignCollaborator->collaborator();
            $this->addQuestionsToCollaborator($campaign, $collaborator);
        }

        $campaign->proceed();
    }

    private function addQuestionsToCollaborator(CampaignModel $campaign, CollaboratorModel $collaborator)
    {
        $campaignQuestions = $campaign->campaignQuestions()->get();

        foreach ($campaignQuestions as $campaignQuestion) {

            $campaignAnswer = new CampaignAnswerModel([
                'campaign_id' => $campaign->getId(),
                'collaborator_id' => $collaborator->getId(),
                'campaign_question_id' => $campaignQuestion->getId(),
            ]);

            $campaignAnswer->save();
        }

        $collaboratorQuestions = $campaign->collaboratorQuestions()->get();
        $campaignCollaborators = $campaign->collaborators()->get();

        foreach ($collaboratorQuestions as $collaboratorQuestion) {
            foreach ($campaignCollaborators as $campaignCollaborator) {
                $campaignCollaboratorAnswer = new CampaignCollaboratorAnswerModel([
                    'campaign_id' => $campaign->getId(),
                    'collaborator_id' => $collaborator->getId(),
                    'subject_id' => $campaignCollaborator->getId(),
                    'campaign_question_id' => $collaboratorQuestion->getId(),
                ]);
                $campaignCollaboratorAnswer->save();
            }
        }
    }

}