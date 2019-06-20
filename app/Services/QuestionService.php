<?php

namespace App\Services;

use App\Models\QuestionModel;

class QuestionService
{
    public function getQuestions()
    {
        return QuestionModel::all()->toArray();
    }

    public function getQuestion(int $id)
    {
        return QuestionModel::find($id)->first();
    }

    public function createQuestion(array $data)
    {
        $question = new QuestionModel($data);
        return $question->save();
    }

    public function update(int $id, array $data)
    {
        $question = QuestionModel::find($id);
        $question->update($data);
        return $question->save();
    }

}