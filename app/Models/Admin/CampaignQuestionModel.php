<?php

namespace App\Models\Admin;

use App\Models\ModelBehavior;
use Illuminate\Database\Eloquent\Model;

class CampaignQuestionModel extends Model
{
    use ModelBehavior;

    protected $table = 'campaign_question';
    protected $fillable = ['campaign_id', 'question', 'description', 'result', 'type'];

    public function isCampaignQuestion()
    {
        return $this->type == 'campaign';
    }

    public function isCollaboratorQuestion()
    {
        return $this->type == 'collaborator';
    }

    public function getType()
    {
        return $this->type;
    }

    public function answers()
    {
        return $this->hasMany(CampaignAnswerModel::class, 'campaign_question_id', 'id');
    }
}