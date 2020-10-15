@extends('layouts.admin_layout')

@section('content')
<div class="col-md-4">
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
</div>
<div class="col-md-4 alert-success text-center">
<h1>INSERT EVENT</h1>
</div>
<div class="col-md-4">
<a href="{{ route('event.index') }}" class="btn btn-primary">Home</a>
</div>
<div class="col-md-12">
<form class="form-horizontal" action="{{ route('event.store') }}" method="POST">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="event-name" class="control-label col-md-4">Event Name</label>
		<div class="col-md-4">
			<input type="text" name="event_name" class="form-control" required>
		</div>
	</div>
	<div class="form-group">
		<label for="event-type" class="control-label col-md-4">Event Type</label>
		<div class="col-md-4">
			<input type="text" name="event_type" class="form-control" required>
		</div>
	</div>
	<div class="form-group">
		<label for="event-participant-limit" class="control-label col-md-4">Event Participant Limit</label>
		<div class="col-md-4">
			<input type="text" name="event_participant_limit" class="form-control" required>
		</div>
	</div>
	<div class="form-group">
		<label for="event-fee" class="control-label col-md-4">Event Fee</label>
		<div class="col-md-4">
			<input type="text" name="event_fee" class="form-control" required>
		</div>
	</div>
	<div class="form-group">
		<label for="event-start-date" class="control-label col-md-4">Event Start Date</label>
		<div class="col-md-4">
			<input type="date" name="event_start_date" class="form-control" required>
		</div>
	</div>
	<div class="form-group">
		<label for="event-end-date" class="control-label col-md-4">Event End Date</label>
		<div class="col-md-4">
			<input type="date" name="event_end_date" class="form-control" required>
		</div>
	</div>
	<div class="form-group">
		<label for="event-start-time" class="control-label col-md-4">Event Start Time</label>
		<div class="col-md-4">
			<input type="time" name="event_start_time" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="event-end-time" class="control-label col-md-4">Event End Time</label>
		<div class="col-md-4">
			<input type="time" name="event_end_time" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="event-venue" class="control-label col-md-4">Event Venue</label>
		<div class="col-md-4">
			<textarea name="event_venue" class="form-control" rows="3" placeholder="Venue" cols="30" required>
			</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-4 col-md-offset-4">
			<input type="submit" name="submit" value="Submit" class="btn btn-success">
		</div>
	</div>
</form>
</div>

@endsection

@section('script')

@endsection