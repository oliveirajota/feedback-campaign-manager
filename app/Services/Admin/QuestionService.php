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
        return QuestionModel::find($id);
    }

    public function createQuestion(array $data)
    {
        $data['owner_id'] = '0c306229-7660-3f8f-a2de-abd51f3a4515';

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