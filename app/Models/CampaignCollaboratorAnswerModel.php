<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignCollaboratorAnswerModel extends Model
{
    use ModelBehavior;

    protected $table = 'campaign_collaborator_answer';
    protected $fillable = ['uuid', 'campaign_id', 'collaborator_id', 'subject_id', 'campaign_question_id', 'private', 'result'];
}