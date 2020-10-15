<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\User;
use App\Models\College;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\EventParticipantMember;

class PaidParticipantExport implements FromView
{
    private $event_id;
    private $event_type;
    public function __construct($event_id,$event_type){
    	$this->event_id = $event_id;
        $this->event_type = $event_type;
    }

    public function view(): View
    {
        $participants = User::join('event_participants',function($join){
            $join->on('event_participants.user_id','=','users.id')->where('users.status','active');
        })
        ->join('events',function($join){
            $join->on('events.id','=','event_participants.event_id')->where(['events.status'=>'active','events.event_type'=>$this->event_type,'events.id'=>$this->event_id])->where(['event_participants.status'=>'active','event_participants.fee'=>'paid']);
        })
        ->orderBy('event_participants.unique_id','DESC')->get();
        $unique_ids=[];
        foreach($participants as $participant){
            $unique_ids[]=$participant['unique_id'];
        }

        $participant_members=[];

        $event_info = Event::where('id',$this->event_id)->firstOrFail();

        if($this->event_type == 'SOLO'){
            foreach($unique_ids as $unique_id){
                $participant_members[] = User::join('event_participants',function($join) use ($unique_id) {
                    $join->on('event_participants.user_id','=','users.id')->where('users.status','active')->where('event_participants.unique_id','=',$unique_id);
                })->orderBy('users.id','ASC')->get();

                /*$participant_members[] = User::join('event_participants',fn($join) => $join->on('event_participants.user_id','=','users.id')->where('users.status','active')->where('event_participants.unique_id','=',$unique_id))->orderBy('users.id','ASC');*/
            }
            return view('excel.solo_excel_view',['event_info'=>$event_info,'participant_members'=>$participant_members]);
        }elseif ($this->event_type == 'GROUP') {
            foreach($unique_ids as $unique_id){
                $participant_members[] = EventParticipantMember::where('unique_id',$unique_id)->get();
            }
            return view('excel.group_excel_view',['event_info'=>$event_info,'participant_members'=>$participant_members]);
        }

    }
}
