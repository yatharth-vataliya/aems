<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Auth;
use Illuminate\Support\Facades\Auth;
use App\Rules\ArrayNotNullRule;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\EventParticipantMember;
use Illuminate\Support\Facades\Gate;
use App\User;

class EventParticipantController extends Controller
{
    public function participantForm(){
        if(session()->has('event_id')){
            $event=session('event_id');
            $event=Event::findOrFail($event);
            return view('participant.participant_form',['event'=>$event]);
        }
        else{
            abort(404);
        }
    }

    public function registerEventParticipant(Request $request){
        if(empty(session('event_id'))){
            return redirect()->route('home');
        }
        $request->validate([
            'eventfile'=>'nullable|file|mimes:mpga,mp3,MP3,mp4,MP4,pdf,doc,docs,docx,ppt,pptx|max:30720',
        ],
        [
            'eventfile.required'=>'Upload your file please',
            'eventfile.mimes'=>'Uploaded file must be valid Type like mp3.',
            'eventfile.max'=>'Maximum allwed size of file is 30MB'
        ]
    );
        $user_count=EventParticipant::where(['user_id'=>Auth::user()->id,'status'=>'active'])->count();
        if($user_count >= 4){
            $errors[]='You can participant in Four event at a time';
            return back()->withErrors($errors);
        }
        $event_id=session('event_id');
        session()->forget('event_id');
        $count = EventParticipant::select('unique_id')->distinct()->count();
        if($count == 0 ){
            $unique_id="UNIQUE_1";
        }else{
            $EventParticipant=EventParticipant::orderBy('id','DESC')->first();
            $lastId=$EventParticipant->unique_id;
            $str_id=explode('_',$lastId);
            $int_id=(int)$str_id[1];
            $int_id++;
            $unique_id="UNIQUE_$int_id";
        }
        if($request->hasFile('eventfile')){
            $path = $request->eventfile->storeAs('public/file',"{$unique_id}.".$request->eventfile->extension());
            Auth::user()->events()->create(['event_id'=>$event_id,'unique_id'=>$unique_id,'file'=>$path]);
            return redirect()->route('profile');
        }else{
            Auth::user()->events()->create(['event_id'=>$event_id,'unique_id'=>$unique_id]);
            return redirect()->route('profile');
        }

    }

    public function registerEventParticipants(Request $request){
        if(empty(session('event_id'))){
            return redirect()->route('home');
        }
        $event_id=session('event_id');
        $event=Event::findOrFail($event_id);
        $limit=$event->event_participant_limit;
        $limit--;
        $request->validate([
         'eventfile'=>'nullable|file|mimes:mpga,mp3,MP3,mp4,MP4,pdf,doc,docs,docx,ppt,pptx|max:30720',
         'names'=>["required","array","max:$limit",new ArrayNotNullRule],
         'mobiles'=>["required","array","max:$limit",new ArrayNotNullRule],
         'emails'=>["required","array","max:$limit",new ArrayNotNullRule],
         'colleges'=>["required","array","max:$limit",new ArrayNotNullRule],
         'departments'=>["required","array","max:$limit",new ArrayNotNullRule],
         'courses'=>["required","array","max:$limit",new ArrayNotNullRule]
     ]);
        session()->forget('event_id');

    // Logic for counting participant limit of user

        $user_count=EventParticipant::where(['user_id'=>Auth::user()->id,'status'=>'active'])->count();
        if($user_count >= 4){
            $errors[]='You can participant in Four event at a time';
            return back()->withErrors($errors);
        }

    // Logic for generating unique id for each group

        $count = EventParticipant::select('unique_id')->distinct()->count();
        if($count == 0 ){
            $unique_id="UNIQUE_1";
        }else{
            $EventParticipant=EventParticipant::orderBy('id','DESC')->first();
            $lastId=$EventParticipant->unique_id;
            $str_id=explode('_',$lastId);
            $int_id=(int)$str_id[1];
            $int_id++;
            $unique_id="UNIQUE_$int_id";
        }

    // Logic for inserting records based on file is uploaded or not

        if($request->hasFile('eventfile')){
            $path = $request->eventfile->storeAs('public/file',"{$unique_id}.".$request->eventfile->extension());
            $event=Auth::user()->events()->create(['event_id'=>$event_id,'unique_id'=>$unique_id,'file'=>$path]);
        }else{
            $event=Auth::user()->events()->create(['event_id'=>$event_id,'unique_id'=>$unique_id]);
        }

    // Logic for inserting event members

        $event->members()->create([
            'user_id'=>Auth::user()->id,
            'unique_id'=>$unique_id,
            'member_name'=>Auth::user()->name,
            'member_mobile'=>Auth::user()->mobile,
            'member_email'=>Auth::user()->email,
            'member_college'=>Auth::user()->college,
            'member_department'=>Auth::user()->department,
            'member_course'=>Auth::user()->course
        ]);

        for($i=0;$i<count($request->input('names'));$i++){
            $event->members()->create([
                'user_id'=>Auth::user()->id,
                'unique_id'=>$unique_id,
                'member_name'=>$request->input('names')[$i],
                'member_mobile'=>$request->input('mobiles')[$i],
                'member_email'=>$request->input('emails')[$i],
                'member_college'=>$request->input('colleges')[$i],
                'member_department'=>$request->input('departments')[$i],
                'member_course'=>$request->input('courses')[$i]
            ]);
        }
        return redirect()->route('profile');
    }

    public function profile(){
        $eventParticipants=Auth::user()->events()
        ->join('events','event_participants.event_id','=','events.id')
        ->where('events.status','=','active')
        ->where('event_participants.status','=','active')
        ->orderBy('event_participants.unique_id','DESC')->get();
        return view('profile.profile',['eventParticipants'=>$eventParticipants]);
    }

    public function removeRegistration($unique_id){
        $eventParticipant=EventParticipant::where('unique_id',$unique_id)->first();
        if(empty($eventParticipant)){
            return redirect()->route('profile');
        }
        if(Auth::user()->id == $eventParticipant->user_id){
            $eventParticipant->update(['status'=>'deactive']);
            $eventParticipantMember = new EventParticipantMember;
            $eventParticipantMember->where('event_participant_id',$eventParticipant->id)->update(['status'=>'deactive']);
            return redirect()->route('profile');
        }else{
            abort(403,"You have no rights to access this page or resource");
        }
    }

    public function viewDetails($unique_id){
     $eventParticipant=EventParticipant::where(['unique_id'=>$unique_id,'status'=>'active'])->first();
     if(empty($eventParticipant)){
        return redirect()->route('profile');
    }
    if(Auth::user()->id == $eventParticipant->user_id){
        $event=Event::findOrFail($eventParticipant->event_id);
        $members=$eventParticipant->members()->where('status','active')->orderBy('id','ASC')->get();
        return view('profile.viewdetails',['event'=>$event,'members'=>$members,'eventParticipant'=>$eventParticipant]);
    }else{
        abort(403,"You have no rights to access this page or resource");
    }
}

public function downloadFile($unique_id){
    $eventParticipant=EventParticipant::where('unique_id',$unique_id)->first();
    if(empty($eventParticipant)){
        return redirect()->route('profile');
    }
    $path=$eventParticipant->file;
    return response()->download("../storage/app/{$path}");
}

public function updateFile(Request $request){
    $request->validate([
        'eventfile'=>'required|file|mimes:mpga,mp3,MP3,mp4,MP4,pdf,doc,docs,docx,ppt,pptx|max:30720',
        'unique_id'=>'required|string'
    ],
    [
        'eventfile.required'=>'Upload your file please',
        'eventfile.mimes'=>'Uploaded file must be valid Type like mp3.',
        'eventfile.max'=>'Maximum allwed size of file is 30MB',
        'unique_id.required'=>'Mr. Hacker Don\'t Change HTML Elements'
    ]);

    $eventParticipant=EventParticipant::where('unique_id',$request->input('unique_id'))->first();
    if(empty($eventParticipant)){
        $errors['exception']='Sorry Something Went Wrong.';
        return back()->withErrors($error);
    }
    if(Auth::user()->id == $eventParticipant->user_id){
        $path = $request->eventfile->storeAs('public/file',"{$request->input('unique_id')}.".$request->eventfile->extension());
        $eventParticipant->update(['file'=>$path]);
        return redirect()->route('profile');
    }else{
        $errors['exception']='User Not Valid.';
        return back()->withErrors($errors);
    }
}

public function deleteMember($member_id){
    $member=EventParticipantMember::findOrFail($member_id);
        // if(Auth::user()->id == $member->user_id){
    if(Gate::allows('can-change',$member)){
        $member->delete();
        return redirect()->back();
    }else{
        $errors['exception']='You are not allowed to delete member of another group that you don\'t belongs.';
        return back()->withErrors($errors);
    }
}

public function addMember(Request $request){
    if(empty(session('event_participant_id')) || empty(session('unique_id')) || empty(session('event_participant_limit'))){
        $errors['exception']='Something Went Wrong Sorry.';
        return back()->withErrors($errors);
    }
    $member_count=EventParticipantMember::where(['status'=>'active','unique_id'=>session('unique_id')])->count();
    if($member_count >= session('event_participant_limit')){
        $errors['exception']='Sorry if you are a programmer or hacker then do not try to inject data in the database.';
        return back()->withErrors($errors);
    }
    $request->validate([
        'member_name'=>'required|string',
        'member_mobile'=>'required|string|size:10',
        'member_email'=>'required|string|email',
        'member_college'=>'required|string',
        'member_department'=>'required|string',
        'member_course'=>'required|string'
    ]);

    EventParticipantMember::create([
        'user_id'=>Auth::user()->id,
        'event_participant_id'=>session('event_participant_id'),
        'unique_id'=>session('unique_id'),
        'member_name'=>$request->input('member_name'),
        'member_mobile'=>$request->input('member_mobile'),
        'member_email'=>$request->input('member_email'),
        'member_college'=>$request->input('member_college'),
        'member_department'=>$request->input('member_department'),
        'member_course'=>$request->input('member_course')
    ]);
    session()->forget('event_participant_id');
    session()->forget('unique_id');
    session()->forget('event_participant_limit');
    return redirect()->back();

}
    public function allSoloEvent(){
        $allSoloEventParticipants=User::join('event_participants',function($join){
            $join->on('event_participants.user_id','=','users.id')->where('users.status','active');
        })
        ->join('events',function($join){
            $join->on('events.id','=','event_participants.event_id')->where(['events.status'=>'active','events.event_type'=>'SOLO'])->where('event_participants.status','active');
        })->orderBy('event_participants.unique_id','DESC')->paginate(100);
        // dd($allSoloEventParticipants);
        return view('admin.all_solo_event_participants',['allSoloEventParticipants'=>$allSoloEventParticipants]);
    }

    public function allGroupEvent(){
        $allGroupEventParticipants=User::join('event_participants',function($join){
            $join->on('event_participants.user_id','=','users.id')->where('users.status','active');
        })
        ->join('events',function($join){
            $join->on('events.id','=','event_participants.event_id')->where(['events.status'=>'active','events.event_type'=>'GROUP'])->where('event_participants.status','active');
        })->orderBy('event_participants.unique_id','DESC')->paginate(100);
        return view('admin.all_group_event_participants',['allGroupEventParticipants'=>$allGroupEventParticipants]);
    }

    public function soloPayFee($unique_id){
        EventParticipant::where('unique_id',$unique_id)->update(['fee'=>'paid']);
        return redirect()->back();
    }

    public function soloUndoPayFee($unique_id){
        EventParticipant::where('unique_id',$unique_id)->update(['fee'=>'pendding']);
        return redirect()->back();
    }

    public function groupPayFee($unique_id){
        EventParticipant::where('unique_id',$unique_id)->update(['fee'=>'paid']);
        EventParticipantMember::where('unique_id',$unique_id)->update(['member_fee'=>'paid']);
        return redirect()->back();
    }

    public function groupUndoPayFee($unique_id){
        EventParticipant::where('unique_id',$unique_id)->update(['fee'=>'pendding']);
        EventParticipantMember::where('unique_id',$unique_id)->update(['member_fee'=>'pendding']);
        return redirect()->back();
    }
}
