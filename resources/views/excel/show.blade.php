@extends('layouts.admin_layout')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-danger">
				<div class="panel-heading">
					For Solo Events
				</div>
				<div class="panel-body text-center" style="overflow-y: scroll;overflow-x: hidden; height: 400px;">
					@foreach(\App\Models\Event::where('event_type','SOLO')->get() as $event)
					<div class="col-md-*">
                        <a href="{{ route('generateExcel',['event_id'=>$event->id,'event_type'=>$event->event_type,'event_name'=>$event->event_name]) }}" class="btn btn-danger btn-block">{{ $event->event_name }}</a>
                    </div>
					@endforeach
				</div>
				<div class="panel-footer">
					
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					For Group Events
				</div>
				<div class="panel-body text-center" style="overflow-y: scroll;overflow-x: hidden; height: 400px;">
					@foreach(\App\Models\Event::where('event_type','GROUP')->get() as $event)
					<div class="col-md-*">
                        <a href="{{ route('generateExcel',['event_id'=>$event->id,'event_type'=>$event->event_type,'event_name'=>$event->event_name]) }}" class="btn btn-success btn-block">{{ $event->event_name }}</a>
                    </div>
					@endforeach
				</div>
				<div class="panel-footer">
					
				</div>
			</div>
		</div>
	</div>
</div>

@endsection