<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CampaignModel extends Model
{
    use ModelBehavior;

    protected $table = 'campaign';

    protected $fillable = ['owner_id', 'name', 'description', 'start_at', 'expire_at'];

    public function questions()
    {
        return $this->hasMany(CampaignQuestionModel::class, 'campaign_id', 'id');
    }

    public function campaignQuestions()
    {
        return $this->hasMany(CampaignQuestionModel::class, 'campaign_id', 'id')
            ->where('type', '=', 'campaign');
    }

    public function collaboratorQuestions()
    {
        return $this->hasMany(CampaignQuestionModel::class, 'campaign_id', 'id')
            ->where('type', '=', 'collaborator');
    }

    public function collaborators()
    {
        return $this->hasMany(CampaignCollaboratorModel::class, 'campaign_id', 'id');
    }

    public function getSummary()
    {
        $collaboratorsCount = $this->collaborators()->count();
        $collaboratorQuestionsCount = $this->collaboratorQuestions()->count();
        $campaignQuestionsCount = $this->campaignQuestions()->count();
        return [
            'collaborators' => $collaboratorsCount,
            'campaign_questions' => $campaignQuestionsCount,
            'collaborator_questions' => $collaboratorQuestionsCount,
            'base_questions' => $this->questions()->count(),
            'total_questions' => ($collaboratorsCount * $collaboratorQuestionsCount) + $campaignQuestionsCount,
            'total_answers' => (($collaboratorsCount * $collaboratorQuestionsCount) + $campaignQuestionsCount) * $collaboratorsCount,
        ];
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['start_at_f'] = date('d/m/Y', strtotime($data['start_at']));
        $data['expire_at_f'] = date('d/m/Y', strtotime($data['expire_at']));
        $data['created_at_f'] = date('d/m/Y', strtotime($data['created_at']));
        $data['updated_at_f'] = date('d/m/Y', strtotime($data['updated_at']));
        $data['is_publishable'] = $this->isPublishable();
        return  $data;
    }

    public function proceed()
    {
        $this->status = 'ready';
        $this->save();
    }

    public function isPublishable()
    {
        return $this->status === 'planning';
    }

}