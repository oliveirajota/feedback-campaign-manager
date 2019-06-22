<?php

namespace App\Models\User;

use App\Models\ModelBehavior;
use Illuminate\Database\Eloquent\Model;

class CollaboratorModel extends Model
{
    use ModelBehavior;

    protected $table = 'collaborator';

    public function pendingCampaigns()
    {
        return $this
            ->select('campaign.*')
            ->from('campaign')
            ->join('campaign_collaborator', 'campaign.id', '=', 'campaign_collaborator.campaign_id')
            ->join('collaborator', 'collaborator.id', '=', 'campaign_collaborator.collaborator_id')
            ->where('campaign_collaborator.collaborator_id', '=', $this->id)
            ->where('campaign.status', '=', 'ready')
            ->get();
    }

    public function campaignAnswers(string $campaignId)
    {
        return $this
            ->select('*')
            ->from('campaign_questions')
//            ->join('campaign_collaborator', 'campaign.id', '=', 'campaign_collaborator.campaign_id')
            ->join('collaborator', 'collaborator.id', '=', 'campaign_questions.collaborator_id')
            ->where('campaign_collaborator.collaborator_id', '=', $this->id)
            ->where('campaign.status', '=', 'ready')
            ->get();
    }
}