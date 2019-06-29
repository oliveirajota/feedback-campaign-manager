<?php

namespace App\Models\Admin;

use App\Models\ModelBehavior;
use Illuminate\Database\Eloquent\Model;

class CampaignAnswerModel extends Model
{
    use ModelBehavior;

    protected $table = 'campaign_answer';
    protected $fillable = ['campaign_id', 'collaborator_id', 'campaign_question_id', 'private', 'result'];

    public function collaborator()
    {
        return $this->hasOne(CollaboratorModel::class, 'id', 'collaborator_id');
    }

    public function toArrayWithCollaborator()
    {
        $array = parent::toArray();
        $array['collaborator'] = $this->collaborator()->first()->toArray();
        return $array;
    }
}