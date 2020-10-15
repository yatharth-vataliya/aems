@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 text-center alert-danger">
			<h2>Username :- {{ Auth::user()->name }}</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-responsive table-striped table-hover table-bordered">
				<tr>
					<th>No.</th>
					<th>Event Name</th>
					<th>Event Type</th>
					<th>Participant Limit</th>
					<th>UNIQUE ID</th>
					<th>Remove Registration</th>
					<th>View Details</th>
				</tr>
				<?php $no=1; ?>
				@foreach($eventParticipants as $eventParticipant)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $eventParticipant->event_name }}</td>
					<td>{{ $eventParticipant->event_type }}</td>
					<td>{{ $eventParticipant->event_participant_limit }}</td>
					<td>{{ $eventParticipant->unique_id }}</td>
					<td><a href="{{ route('removeRegistration',['unique_id'=>$eventParticipant->unique_id]) }}" class="btn btn-danger">Remove Registration</a></td>
					<td><a href="{{ route('viewDetails',['unique_id'=>$eventParticipant->unique_id]) }}" class="btn btn-primary">View Deatils</a></td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection

@section('script')



@endsection