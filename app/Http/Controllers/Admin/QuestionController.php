<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

class QuestionController extends Controller
{

    const FIELDS = [
        'question', 'description', 'type'
    ];

    const RULES = [
        'question' => 'required',
        'type' => 'required'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionService = new QuestionService();
        return view('admin.question.index', [
            'questions' => $questionService->getQuestions()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.question.create', [
            'questionType' => [
                'collaborator' => "Question related to a Collaborator",
                'campaign' => "Question related to a Feedback Campaign",
            ]
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

        $questionService = new QuestionService();
        $questionService->createQuestion($data);
        return redirect(route('questions.index'))->with([
            'msg' => [
                'type' => 'success',
                'txt' => 'Question Created Successfully'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $questionService = new QuestionService();
        $question = $questionService->getQuestion($id);

        return view('admin.question.edit', [
            'question' => $question,
            'questionType' => [
                'collaborator' => "Question related to a Collaborator",
                'campaign' => "Question related to a Feedback Campaign",
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(self::FIELDS);

        $validation = ValidatorFacade::make($data, self::RULES);
        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $questionService = new QuestionService();
        $questionService->update($id, $data);

        return redirect(route('questions.index'))->with([
            'msg' => [
                'type' => 'success',
                'txt' => 'Question Updated Successfully'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
