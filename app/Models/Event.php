<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=[
    	'event_name',
    	'event_type',
    	'event_participant_limit',
    	'event_fee',
    	'event_start_date',
    	'event_end_date',
    	'event_start_time',
    	'event_end_time',
        'event_venue',
        'status'
    ];

    public static function getSoloEvent(){
        return self::where(['event_type'=>'SOLO','status'=>'active'])->get();
    }

    public static function getGroupEvent(){
        return self::where(['event_type'=>'GROUP','status'=>'active'])->get();
    }

    public static function getOtherEvent(){
        return self::where('status','active')->whereNotIn('event_type', ['SOLO','GROUP'])->get();
    }

    public function changeStatus(){
        $this->status == 'active' ? $this->update(['status'=>'deactive']) : $this->update(['status'=>'active']);
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
