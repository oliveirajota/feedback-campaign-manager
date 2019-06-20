<?php

namespace App\Models\User;

use App\Models\Admin\CampaignCollaboratorModel;
use App\Models\Admin\CampaignQuestionModel;
use App\Models\ModelBehavior;
use Illuminate\Database\Eloquent\Model;

class CampaignModel extends Model
{
    use ModelBehavior;

    protected $table = 'campaign';

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

    public function isPublishable()
    {
        return $this->status === 'planning';
    }
}