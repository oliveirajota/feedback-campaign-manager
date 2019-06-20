<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignQuestionModel extends Model
{
    use ModelBehavior;

    protected $table = 'campaign_question';
    protected $fillable = ['uuid', 'campaign_id', 'question', 'description', 'result', 'type'];

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
}