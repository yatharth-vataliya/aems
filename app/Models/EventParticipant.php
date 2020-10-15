<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    protected $fillable=['user_id','event_id','unique_id','file','status'];

    public function members(){
        return $this->hasMany('App\Models\EventParticipantMember');
    }
}
