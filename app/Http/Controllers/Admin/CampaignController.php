<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CollaboratorService;
use App\Services\Admin\CompanyService;
use App\Services\Admin\CampaignService;
use App\Services\Admin\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

class CampaignController extends Controller
{

    const FIELDS = [
        'name', 'description', 'start_at', 'expire_at'
    ];

    const RULES = [
        'name' => 'required',
        'description' => 'required',
        'start_at' => 'required|after_or_equal:today',
        'expire_at' => 'required|after_or_equal:tomorrow|after:start_at',
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaignService = new CampaignService();
        return view('admin.campaign.index', [
            'campaigns' => $campaignService->getCampaignsWithCollaborators()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companyService = new CompanyService();
        $companies = $companyService->getCompanies();

        if (empty($companies)) {
            return redirect(route('companies.create'))->with([
                'msg' => [
                    'type' => 'info',
                    'txt' => 'Before Create an Feedback Campaign you need to create a Company'
                ]
            ]);
        }
        return view('admin.campaign.create', [
            'companies' => $companyService->getCompaniesSelector()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(self::FIELDS);

        $validation = ValidatorFacade::make($data, self::RULES);
        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $user = Auth()->user();

        $campaignService = new CampaignService();
        $campaignService->createCampaign($data, $user);

        return redirect(route('campaigns.index'))->with([
            'msg' => [
                'type' => 'success',
                'txt' => 'Campaign Created Successfully'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $campaignService = new CampaignService();

        $campaign = $campaignService->getCampaign($id);

        return view('admin.campaign.show', [
            'campaign' => $campaign->toArray(),
            'questions' => $campaign->questions()->get()->toArray(),
            'collaborators' => $campaign->collaborators()->get()->toArray(),
            'summary' => $campaign->getSummary()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaignService = new CampaignService();
        $campaign = $campaignService->getCampaign($id);

        $companyService = new CompanyService();

        return view('admin.campaign.edit', [
            'campaign' => $campaign,
            'companies' => $companyService->getCompaniesSelector()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addQuestions(string $id)
    {
        $campaignService = new CampaignService();
        $campaign = $campaignService->getCampaign($id);

        $questionService = new QuestionService();

        return view('admin.campaign.questions', [
            'campaign' => $campaign->toArray(),
            'questions' => $questionService->getQuestions()
        ]);
    }

    public function addQuestion(string $id, string $questionId)
    {
        $campaignService = new CampaignService();
        $campaign = $campaignService->getCampaign($id);
        $result = $campaignService->addQuestion($campaign, $questionId);

        $msg = $result ? [
            'type' => 'success',
            'txt' => 'Question Added Successfully'
        ] : [
            'type' => 'danger',
            'txt' => 'Error Adding Question'
        ];

        return redirect('/campaigns/' . $id . '/questions/add')->with(['msg' => $msg]);
    }

    public function addCollaborators(string $id)
    {
        $campaignService = new CampaignService();
        $campaign = $campaignService->getCampaign($id);

        $collaboratorService = new CollaboratorService();

        return view('admin.campaign.collaborators', [
            'campaign' => $campaign->toArray(),
            'collaborators' => $collaboratorService->getCollaborators()
        ]);
    }

    public function addCollaborator(string $id, string $collaboratorId)
    {
        $campaignService = new CampaignService();
        $campaign = $campaignService->getCampaign($id);
        $result = $campaignService->addCollaborator($campaign, $collaboratorId);

        $msg = $result ? [
            'type' => 'success',
            'txt' => 'Collaborator Added Successfully'
        ] : [
            'type' => 'danger',
            'txt' => 'Error Adding Question'
        ];

        return redirect('/campaigns/' . $id . '/collaborators/add')->with(['msg' => $msg]);
    }

    public function publishView(string $id)
    {
        $campaignService = new CampaignService();
        $campaign = $campaignService->getCampaign($id);

        return view('admin.campaign.publish', [
            'campaign' => $campaign->toArray(),
            'questions' => $campaign->questions()->get()->toArray(),
            'campaignQuestions' => $campaign->campaignQuestions()->get()->toArray(),
            'collaboratorQuestions' => $campaign->collaboratorQuestions()->get()->toArray(),
            'collaborators' => $campaign->collaborators()->get()->toArray(),
            'summary' => $campaign->getSummary()
        ]);
    }

    public function publishPost(Request $request, string $campaignId)
    {
        $campaignService = new CampaignService();
        $campaignService->publish($campaignId);

        $msg = [
            'type' => 'success',
            'txt' => 'Campaign Published Successfully'
        ];

        return redirect('/campaigns/' . $campaignId )->with(['msg' => $msg]);
    }

    public function seeResults(string $id)
    {
        $campaignService = new CampaignService();
        $campaignData = $campaignService->getCampaignWithResults($id);

//        dd($campaignData['collaborators']);

        return view('admin.campaign.results', [
            'campaign' => $campaignData['campaign'],
//            'results' => $campaign->getCollaboratorsResults()->toArray(),
//            'campaignQuestions' => $campaign->campaignQuestions()->get()->toArray(),
//            'collaboratorQuestions' => $campaign->collaboratorQuestions()->get()->toArray(),
            'collaborators' => $campaignData['collaborators'],
//            'summary' => $campaign->getSummary()
        ]);
    }
}
