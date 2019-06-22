<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class CampaignCollaboratorAnswerModel extends Model
{
    protected $table = 'campaign_collaborator_answer';
    protected $fillable = ['comment', 'result', 'private'];
}