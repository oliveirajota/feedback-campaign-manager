<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CampaignCollaboratorModel extends Model
{
    use ModelBehavior;

    protected $table = 'campaign_collaborator';
    protected $fillable = ['campaign_id', 'collaborator_id', 'status'];

    public function collaborator()
    {
        return $this->hasOne(CollaboratorModel::class, 'id', 'collaborator_id' )->first();
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['collaborator'] = $this->collaborator()->toArray();

        return $data;
    }

    public function getCollaboratorId()
    {
        return $this->collaborator()->getId();
    }
}