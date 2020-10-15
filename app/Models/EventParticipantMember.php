<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventParticipantMember extends Model
{
    protected $fillable=[
    	'user_id',
    	'event_participant_id',
    	'unique_id',
    	'member_name',
    	'member_mobile',
    	'member_email',
    	'member_college',
    	'member_department',
    	'member_course',
    	'status'
    ];
}
