@extends('layouts.admin_layout')
@section('content')
<div class="col-md-4"><a href="{{ route('event.create') }}" class="btn btn-primary">Create Event</a></div>
<div class="col-md-4"></div>
<div class="col-md-4"></div>
<div class="col-md-12">
	<table class="table table-hover table-responsive table-bordered table-striped">
		<tr>
			<th>No.</th>
			<th>Event Name</th>
			<th>Event Type</th>
			<th>Event Participant Limit</th>
			<th>Event Fee</th>
			<th>Event Start Date</th>
			<th>Event End Date</th>
			<th>Event Start time</th>
			<th>Event End Time</th>
			<th>Event Venue</th>
			<th>Event Status</th>
			<th>Edit Event</th>
		</tr>
		@php
		$no=1;
		@endphp
		@foreach($events as $event)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $event->event_name }}</td>
			<td>{{ $event->event_type }}</td>
			<td>{{ $event->event_participant_limit }}</td>
			<td>{{ $event->event_fee }}</td>
			<td>{{ $event->event_start_date }}</td>
			<td>{{ $event->event_end_date }}</td>
			<td>{{ $event->event_start_time }}</td>
			<td>{{ $event->event_end_time }}</td>
			<td>{{ $event->event_venue }}</td>
				<td>
					<form action="{{ route('event.destroy',['id'=>$event->id]) }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						@if($event->status == 'active')
							<input type="submit" name="submit" value="Active" class="btn btn-success">
						@else
							<input type="submit" name="submit" value="Deactive" class="btn btn-danger">
						@endif
					</form>
				</td>
			<td><a href="{{ route('event.edit',['id'=>$event->id]) }}" class="btn btn-danger">Edit</a></td>
		</tr>
		@endforeach
	</table>
</div>
<div class="col-md-6 col-md-offset-2 text-center">{{ $events->links() }}</div>
@endsection
@section('script')

@endsection