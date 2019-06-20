<?php

namespace App\Services\Admin;

use App\Models\Admin\QuestionModel;

class QuestionService
{
    public function getQuestions()
    {
        return QuestionModel::all()->toArray();
    }

    public function getQuestion(string $id)
    {
        return QuestionModel::find($id)->first();
    }

    public function createQuestion(array $data)
    {
        $question = new QuestionModel($data);
        return $question->save();
    }

    public function update(string $id, array $data)
    {
        $question = QuestionModel::find($id);
        $question->update($data);
        return $question->save();
    }

}