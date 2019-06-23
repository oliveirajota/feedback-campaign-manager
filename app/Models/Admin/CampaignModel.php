<?php

namespace App\Models\Admin;

use App\Models\ModelBehavior;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getFormattedFields()
    {
        $array = $this->toArray();
        $data['start_at_f'] = date('d/m/Y', strtotime($array['start_at']));
        $data['expire_at_f'] = date('d/m/Y', strtotime($array['expire_at']));
        $data['created_at_f'] = date('d/m/Y', strtotime($array['created_at']));
        $data['updated_at_f'] = date('d/m/Y', strtotime($array['updated_at']));
        $data['is_publishable'] = $this->isPublishable();
        return $data;
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

    public function getCollaboratorsResults()
    {
        return $this
            ->select([
                'collaborator.*',
                DB::raw('CAST(SUM(campaign_collaborator_answer.result) as UNSIGNED) AS total'),
                DB::raw('COUNT(subject_id) as cnt'),
                DB::raw('CAST((SUM(campaign_collaborator_answer.result) / COUNT(subject_id)) AS DECIMAL(5,2)) as avg'),
            ])
            ->from('campaign_collaborator_answer')
            ->join('collaborator', 'campaign_collaborator_answer.subject_id', '=', 'collaborator.id')
            ->where('campaign_collaborator_answer.campaign_id', '=', $this->id)
            ->groupBy('campaign_collaborator_answer.subject_id')
            ->get();
    }

    public function getCampaignResults()
    {
        return $this
            ->select([
                'campaign_question.*',
                DB::raw('CAST(SUM(campaign_answer.result) as UNSIGNED) AS total'),
                DB::raw('COUNT(collaborator_id) as cnt'),
                DB::raw('CAST((SUM(campaign_answer.result) / COUNT(collaborator_id)) AS DECIMAL(5,2)) as avg'),
            ])
            ->from('campaign_answer')
            ->join('campaign_question', 'campaign_answer.campaign_question_id', '=', 'campaign_question.id')
            ->where('campaign_answer.campaign_id', '=', $this->id)
            ->groupBy('campaign_answer.campaign_question_id')
            ->get();
    }



}