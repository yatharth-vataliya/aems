@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Event Info</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-6 text-center alert-info" style="color: black;border-radius: 7px;">
						<h4><strong>Event Name :-</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-danger" style="border-radius: 7px;">
						<h4><strong>{{ $event->event_name }}</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-info" style="color: black;border-radius: 7px;">
						<h4><strong>Event Type :-</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-danger" style="border-radius: 7px;">
						<h4><strong>{{ $event->event_type }}</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-info" style="color: black;border-radius: 7px;">
						<h4><strong>Event Participant Limit :-</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-danger" style="border-radius: 7px;">
						<h4><strong>{{ $event->event_participant_limit }}</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-info" style="color: black;border-radius: 7px;">
						<h4><strong>Event Fee :-</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-danger" style="border-radius: 7px;">
						<h4><strong>{{ $event->event_fee }}</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-info" style="color: black;border-radius: 7px;">
						<h4><strong>Event Start Date :-</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-danger" style="border-radius: 7px;">
						<h4><strong>{{ $event->event_start_date }}</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-info" style="color: black;border-radius: 7px;">
						<h4><strong>Event End Date :-</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-danger" style="border-radius: 7px;">
						<h4><strong>{{ $event->event_end_date }}</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-info" style="color: black;border-radius: 7px;">
						<h4><strong>Event Start Time :-</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-danger" style="border-radius: 7px;">
						<h4><strong>{{ isset($event->event_start_time) ? $event->event_start_time : 'Not Specified' }}</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-info" style="color: black;border-radius: 7px;">
						<h4><strong>Event End Time :-</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-danger" style="border-radius: 7px;">
						<h4><strong>{{ isset($event->event_end_time) ? $event->event_end_time : 'Not Specified' }}</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-info" style="color: black;border-radius: 7px;">
						<h4><strong>Event Venue :-</strong></h4>
					</div>
					<div class="col-md-6 text-center alert-danger" style="border-radius: 7px;">
						<h4><strong>{{ $event->event_venue }}</strong></h4>
					</div>
				</div>
				<div class="panel-footer">
					@php
					session(['event_id'=>$event->id])
					@endphp
					<a href="{{ route('participantForm') }}" class="btn btn-primary">Participant</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')

@endsection