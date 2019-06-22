<?php

namespace App\Models\User;

use App\Models\Admin\CampaignCollaboratorModel;
use App\Models\ModelBehavior;
use Illuminate\Database\Eloquent\Model;

class CampaignModel extends Model
{
    use ModelBehavior;

    protected $table = 'campaign';

    public function campaignQuestions()
    {
        return $this->hasMany(CampaignQuestionModel::class, 'campaign_id', 'id')
            ->where('type', '=', 'campaign');
    }


    public function collaborators()
    {
        return $this->hasMany(CampaignCollaboratorModel::class, 'campaign_id', 'id');
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['start_at_f'] = date('d/m/Y', strtotime($data['start_at']));
        $data['expire_at_f'] = date('d/m/Y', strtotime($data['expire_at']));
        $data['created_at_f'] = date('d/m/Y', strtotime($data['created_at']));
        $data['updated_at_f'] = date('d/m/Y', strtotime($data['updated_at']));
        return  $data;
    }

    public function campaignAnswersByCollaborator(string $collaboratorId)
    {
        return $this
            ->select(['campaign.*', 'campaign_question.*', 'campaign_answer.*', 'campaign_answer.id as id'])
            ->from('campaign_answer')
            ->join('campaign', 'campaign.id', '=', 'campaign_answer.campaign_id')
            ->join('campaign_question', 'campaign_answer.campaign_question_id', '=', 'campaign_question.id')
            ->where('campaign_answer.campaign_id', '=', $this->id)
            ->where('campaign_answer.collaborator_id', '=', $collaboratorId)
            ->get();
    }

    public function campaignCollaboratorAnswersByCollaborator(string $collaboratorId, string $subjectId)
    {
        return $this
            ->select(['campaign.*', 'campaign_question.*', 'campaign_collaborator_answer.*', 'campaign_collaborator_answer.id as id'])
            ->from('campaign_collaborator_answer')
            ->join('campaign', 'campaign.id', '=', 'campaign_collaborator_answer.campaign_id')
            ->join('campaign_question', 'campaign_collaborator_answer.campaign_question_id', '=', 'campaign_question.id')
            ->where('campaign_collaborator_answer.campaign_id', '=', $this->id)
            ->where('campaign_collaborator_answer.collaborator_id', '=', $collaboratorId)
            ->where('campaign_collaborator_answer.subject_id', '=', $subjectId)
            ->get();
    }
}