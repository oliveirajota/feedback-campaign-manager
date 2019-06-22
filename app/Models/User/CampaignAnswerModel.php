<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class CampaignAnswerModel extends Model
{
    protected $table = 'campaign_answer';
    protected $fillable = ['comment', 'result', 'private'];
}