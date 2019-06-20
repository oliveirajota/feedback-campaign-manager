<?php

namespace App\Http\Controllers;


use App\Services\CampaignService;

class UserHomeController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $campaignService = new CampaignService();
        $collaborator = $campaignService->getCollaboratorByUser($user);

        $dashboard = $campaignService->getUserDashboard($collaborator);

        return view('user.dashboard', [
            'dashboard' => $dashboard
        ]);
    }
}