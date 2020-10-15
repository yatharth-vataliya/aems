@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@include('layouts.errors')
		</div>
	</div>
</div>
@if($event->event_participant_limit == '1')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default panel-primary">
				<div class="panel-heading">Event Registration</div>
				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ route('registerEventParticipant') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="participant-name" class="col-md-4 control-label">Participant Name</label>
							<div class="col-md-6">
								<input class="form-control" value="{{ auth()->user()->name }}" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="event-name" class="col-md-4 control-label">Event Name</label>
							<div class="col-md-6">
								<input class="form-control" value="{{ $event->event_name }}" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="event-type" class="col-md-4 control-label">Event Type</label>
							<div class="col-md-6">
								<input class="form-control" value="{{ $event->event_type }}" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="participant limit" class="col-md-4 control-label">Participant Limit</label>
							<div class="col-md-6">
								<input class="form-control" name="email" value="{{ $event->event_participant_limit }}" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="event-fee" class="col-md-4 control-label">Event Fee</label>
							<div class="col-md-6">
								<input class="form-control" name="email" value="{{ $event->event_fee }}" readonly>
							</div>
						</div>
						<div class="form-group {{ $errors->has('eventfile') ? 'alert-danger' : '' }}">
							<label for="file-upload" class="col-md-4 control-label">
								{{ ($event->event_type == 'GROUP' || $event->event_type == 'SOLO') ? 'Upload Song' : 'Upload Your File' }}
							</label>
							<div class="col-md-6">
								<input type="file" class="form-control alert-info" name="eventfile">
								<span class="help-block text-justify">You must have to upload your file either this time or after registration complete and you can edit or change song before event registration closed.</span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-4 col-md-6">
								<input type="submit" name="submit" value="Participant" class="btn btn-primary">
							</div>
						</div>
					</form>
				</div>
				<div class="panel-footer">
					Thank You For Registration.
				</div>
			</div>
		</div>
	</div>
</div>
@else

<div class="container-fluid">
	<form class="form-horizontal" method="POST" action="{{ route('registerEventParticipants') }}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">	
			<div class="col-md-offset-2 col-md-8">
				<div class="panel panel-default panel-success">
					<div class="panel-heading">Event Registration</div>

					<div class="panel-body">
						<div class="form-group">
							<label for="participant-name" class="col-md-4 control-label">Participant Name</label>
							<div class="col-md-6">
								<input class="form-control" value="{{ auth()->user()->name }}" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="event-name" class="col-md-4 control-label">Event Name</label>
							<div class="col-md-6">
								<input class="form-control" value="{{ $event->event_name }}" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="event-type" class="col-md-4 control-label">Event Type</label>
							<div class="col-md-6">
								<input class="form-control" value="{{ $event->event_type }}" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="participant limit" class="col-md-4 control-label">Participant Limit</label>
							<div class="col-md-6">
								<input class="form-control" value="{{ $event->event_participant_limit }}" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="event-fee" class="col-md-4 control-label">Event Fee</label>
							<div class="col-md-6">
								<input class="form-control" value="{{ $event->event_fee }}" readonly>
							</div>
						</div>
						<div class="form-group {{ $errors->has('eventfile') ? 'alert-danger' : '' }}">
							<label for="file-upload" class="col-md-4 control-label">
								{{ ($event->event_type == 'GROUP' || $event->event_type == 'SOLO') ? 'Upload Song' : 'Upload Your File' }}
							</label>
							<div class="col-md-6">
								<input type="file" class="form-control alert-info" name="eventfile">
								<span class="help-block text-justify">You must have to upload your file either this time or after registration complete and you can edit or change song before event registration closed.</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-6">Add Member</div>
							<div class="col-md-6 text-right">
								<button type="button" onclick="addField();getColleges();getDepartments();getCourses()" class="btn btn-success">Add</button>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div id="mainfield">

						</div>
					</div>
					<div class="panel-footer">
						<input type="submit" value="Register" name="submit" class="btn btn-success">
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

@endif

@endsection

@section('script')
<script>
	var count=2;
	var no=1;
	function addField(){
		var limit=parseInt("{{ (int)$event->event_participant_limit }}");
		if(count <= limit){
			count++;
			$("#mainfield").append('<div id="'+count+'" class="col-md-12 form-inline">No.'+no+' &nbsp; &nbsp;<input type="text" name="names[]" class="form-control" placeholder="Name"><input type="text" name="mobiles[]" class="form-control" placeholder="Mobile"><input type="email" name="emails[]" class="form-control" placeholder="E-mail"><select id="colleges'+count+'" name="colleges[]" class="form-control" required><option>-select-College-</option></select><select id="departments'+count+'" name="departments[]" class="form-control" required><option>-select-Department-</option></select><select id="courses'+count+'" name="courses[]" class="form-control" required><option>-select-Course-</option></select><button type="button" id="remove" onclick="removeField(this.value)" value="'+count+'" class="btn btn-danger">Remove</button></div>');
		}
		no++;
	}

	function removeField(value){
		var del=value;
		document.getElementById(del).innerHTML='';
	}

	function getColleges(){
		$(document).ready(function() {
			$.ajax({
				url: '{{ route("getColleges") }}',
				type: 'POST',
				data: {'_token' : $('input[name=_token]').val()},
				success:function(data){
					$("#colleges"+count).html(data);
				},
			});            
		});
	}

	function getDepartments(){

		$(document).ready(function() {
			$.ajax({
				url: '{{ route("getDepartments") }}',
				type: 'POST',
				data: {'_token' : $('input[name=_token]').val()},
				success:function(data){
					$("#departments"+count).html(data);
				},
			});            
		});
	}

	function getCourses(){

		$(document).ready(function() {
			$.ajax({
				url: '{{ route("getCourses") }}',
				type: 'POST',
				data: {'_token' : $('input[name=_token]').val()},
				success:function(data){
					$("#courses"+count).html(data);
				},
			});            
		});
	}

</script>
@endsection