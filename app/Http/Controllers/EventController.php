<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Rules\Uppercase;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events=Event::orderBy('event_name','asc')->paginate(10);
        return view('event.show_event',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create_event');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_name'=>'required|string|max:255',
            'event_type'=> ['required','max:100','string',new Uppercase],
            'event_participant_limit'=>"required|string|max:3",
            'event_fee'=>'required|string|max:5',
            'event_start_date'=>'required|date',
            'event_end_date'=>'required|date',
            'event_start_time'=>'string|nullable',
            'event_end_time'=>'string|nullable',
            'event_venue'=>'required|string'
        ]);

        if ($request->event_type == 'SOLO') {
            if ($request->event_participant_limit == 1) {
                Event::create($request->all());
                return redirect()->route('event.index');
            }else{
                return back()->withErrors(['SOLO Event have not more than one member']);
            }
        }

        Event::create($request->all());
        return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        
    }

    public function eventShow(Event $event)
    {
        if($event->status == 'active'){
            return view('event.specific_event',compact('event'));
        }
        else{
            abort(403, 'Sorry Requested Event is Not Found');       
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('event.edit_event',['event'=>$event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event_name'=>'required|string|max:255',
            'event_type'=> ['required','max:100','string',new Uppercase],
            'event_participant_limit'=>"required|string|max:3",
            'event_fee'=>'required|string|max:5',
            'event_start_date'=>'required|date',
            'event_end_date'=>'required|date',
            'event_start_time'=>'string|nullable',
            'event_end_time'=>'string|nullable',
            'event_venue'=>'string|nullable'
        ]);

        $event->update($request->all());
        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->changeStatus();
        return redirect()->route('event.index');
    }
}
