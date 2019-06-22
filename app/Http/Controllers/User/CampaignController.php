<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\CampaignService;
use Illuminate\Http\Request;

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

    public function viewQuestions(string $id)
    {
        $campaignService = new CampaignService();
        $campaign = $campaignService->getCampaignById($id);

        $user = Auth()->user();

        $collaborator = $campaignService->getCollaboratorByUser($user);
        $questions = $campaign->campaignAnswersByCollaborator($collaborator->getId())->toArray();

        $questionResults = array_map(function ($question) {
            return $question['result'];
        }, $questions);

        return view('user.campaign.questions', [
            'campaign' => $campaign->toArray(),
            'questions' => $questions,
            'questionResults' => $questionResults,
        ]);
    }

    public function saveAnswers(Request $request)
    {
        $data = $request->only(['id', 'result', 'comment']);
        $campaignId = $request->get('campaign_id');
        $campaignService = new CampaignService();
        $campaignService->saveAnswers($data, $campaignId);

        return back()->with(['msg' => [
            'type' => 'success',
            'txt' => 'Answers Updated Successfully'
        ]]);

    }

    public function viewCollaboratorQuestions(string $campaignId, string $subjectId)
    {
        $campaignService = new CampaignService();
        $campaign = $campaignService->getCampaignById($campaignId);

        $user = Auth()->user();

        $collaborator = $campaignService->getCollaboratorByUser($user);
        $questions = $campaign->campaignCollaboratorAnswersByCollaborator($collaborator->getId(), $subjectId)->toArray();

        $questionResults = array_map(function ($question) {
            return $question['result'];
        }, $questions);

        return view('user.campaign.collaborator-questions', [
            'campaign' => $campaign->toArray(),
            'questions' => $questions,
            'questionResults' => $questionResults,
            'subjectId' => $subjectId
        ]);
    }

    public function saveCollaboratorAnswers(Request $request)
    {
        $data = $request->only(['id', 'result', 'comment']);
        $campaignId = $request->get('campaign_id');
        $campaignService = new CampaignService();
        $campaignService->saveCollaboratorAnswers($data, $campaignId);

        return back()->with(['msg' => [
            'type' => 'success',
            'txt' => 'Answers Updated Successfully'
        ]]);

    }
}