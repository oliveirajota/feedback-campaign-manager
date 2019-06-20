<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignAnswerModel extends Model
{
    use ModelBehavior;

    protected $table = 'campaign_answer';
    protected $fillable = ['campaign_id', 'collaborator_id', 'campaign_question_id', 'private', 'result'];
}