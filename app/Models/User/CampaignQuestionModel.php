<?php

namespace App\Models\User;

use App\Models\ModelBehavior;
use Illuminate\Database\Eloquent\Model;

class CampaignQuestionModel extends Model
{
    use ModelBehavior;

    protected $table = 'campaign_question';
    protected $fillable = ['question', 'description', 'type'];

    public function answer()
    {
        return $this->hasOne(
            CampaignAnswerModel::class,
            'campaign_question_id',
            'id'
        );

    }
}