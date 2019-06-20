<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\CampaignService;

class CampaignController extends Controller
{

    public function view(string $id)
    {
        $campaignService = new CampaignService();
        $campaign = $campaignService->getCampaignById($id);

        return view('user.campaign.show', [
            'campaign' => $campaign->toArray(),
            'questions' => $campaign->campaignQuestions()->get()->toArray(),
            'collaborators' => $campaign->collaborators()->get()->toArray(),
//            'summary' => $campaign->getSummary()
        ]);
    }
}