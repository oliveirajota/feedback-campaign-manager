<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\CampaignService;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $campaignService = new CampaignService();
        $collaborator = $campaignService->getCollaboratorByUser($user);

        $dashboard = $campaignService->getUserDashboard($collaborator);

        return view('user.dashboard', $dashboard);
    }
}