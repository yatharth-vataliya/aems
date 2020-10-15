@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			@include('layouts.errors')
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="{{ $event->event_participant_limit > 1 ? 'col-md-4' : 'col-md-offset-2 col-md-8' }}">
				<div class="panel panel-success">
					<div class="panel-heading">
						<strong>Event Info</strong>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<strong>Unique Id:-</strong>
							</div>
							<div class="col-md-6 alert-danger" style="border-radius: 5px;">
								{{ $eventParticipant->unique_id }}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<strong>Event Name:-</strong>
							</div>
							<div class="col-md-6 alert-danger" style="border-radius: 5px;">
								{{ $event->event_name }}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<strong>Event Type:-</strong>
							</div>
							<div class="col-md-6 alert-danger" style="border-radius: 5px;">
								{{ $event->event_type }}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<strong>Event Participant Limit:-</strong>
							</div>
							<div class="col-md-6 alert-danger" style="border-radius: 5px;">
								{{ $event->event_participant_limit }}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<strong>Event Start Date:-</strong>
							</div>
							<div class="col-md-6 alert-danger" style="border-radius: 5px;">
								{{ $event->event_start_date }}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<strong>Event End Date:-</strong>
							</div>
							<div class="col-md-6 alert-danger" style="border-radius: 5px;">
								{{ $event->event_end_date }}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<strong>Event Start Time:-</strong>
							</div>
							<div class="col-md-6 alert-danger" style="border-radius: 5px;">
								{{ (!empty($event->event_start_time)) ? : 'Not Specified' }}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<strong>Event End Time:-</strong>
							</div>
							<div class="col-md-6 alert-danger" style="border-radius: 5px;">
								{{ (!empty($event->event_end_time)) ? : 'Not Specified' }}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<strong>Event Venue:-</strong>
							</div>
							<div class="col-md-6 alert-danger" style="border-radius: 5px;">
								{{ $event->event_venue }}
							</div>	
						</div>
					</div>
					<div class="panel-footer">
						@if(!empty($eventParticipant->file) && $eventParticipant->file != 'not submited')
						<a href="{{ route('downloadFile',['unique_id'=>$eventParticipant->unique_id]) }}" class="btn btn-primary" >Download File</a>
						<form action="{{ route('updateFile') }}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							{{ method_field('PATCH') }}
							<input type="hidden" name="unique_id" value="{{ $eventParticipant->unique_id }}">
							<input type="file" class="form-control alert-success" name="eventfile">
							<input type="submit" value="Update File" name="submit" class="btn btn-success">
						</form>
						@else
						<form action="{{ route('updateFile') }}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							{{ method_field('PATCH') }}
							<input type="hidden" name="unique_id" value="{{ $eventParticipant->unique_id }}">
							<input type="file" class="form-control alert-success" name="eventfile">
							<input type="submit" value="Upload File" name="submit" class="btn btn-success">
						</form>
						@endif
					</div>
				</div>
			</div>
			@if($event->event_participant_limit > 1)
			<div class="col-md-8">
				<table class="table table-hover table-bordered table-responsive table-striped">
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Mobile</th>
						<th>College</th>
						<th>Department</th>
						<th>Course</th>
						<th>Delete</th>
						<th>Certificate</th>
					</tr>
					@php
					$no=1;
					@endphp
					@foreach($members as $member)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $member->member_name }}</td>
						<td>{{ $member->member_mobile }}</td>
						<td>{{ $member->member_college }}</td>
						<td>{{ $member->member_department }}</td>
						<td>{{ $member->member_course }}</td>
						@if(!$loop->first)
						<td>
							<a href="{{ route('deleteMember',['member_id'=>$member->id]) }}" class="btn btn-danger">Delete</a>
						</td>
						@else
						<td></td>
						@endif
						<td>
							@if($member->member_certificate == 'notgenerated')
								Not Generated
							@elseif(($member->member_certificate == 'generated'))
								<a href="" class="btn btn-success">Get It</a>
							@endif
						</td>
					</tr>
					@endforeach
				</table>
				@php
				session(['event_participant_id'=>$eventParticipant->id]);
				session(['unique_id'=>$eventParticipant->unique_id]);
				session(['event_participant_limit'=>$event->event_participant_limit]);
				@endphp
				@if( --$no < $event->event_participant_limit)
				<div class="col-md-12"><button type="button" class="btn btn-primary btn-block" onclick="addMember();getColleges();getDepartments();getCourses()">Add Member</button></div>
				<form action="{{ route('addMember') }}" method="POST">
					{{ csrf_field() }}
					<div id="member">

					</div>
				</form>
				@endif
			</div>
			@endif
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	function addMember(){
		$(document).ready(function() {
			$("#member").html('<input type="text" name="member_name" class="form-control" placeholder="Name"><input type="text" name="member_mobile" class="form-control" placeholder="Mobile"><input type="email" name="member_email" class="form-control" placeholder="E-mail"><select id="colleges" name="member_college" class="form-control" required><option>-select-College-</option></select><select id="departments" name="member_department" class="form-control" required><option>-select-Department-</option></select><select id="courses" name="member_course" class="form-control" required><option>-select-Course-</option></select><input type="submit" name="submit" value="Add" class="btn btn-success btn-block">');
		});
	}

	function getColleges(){
		$(document).ready(function() {
			$.ajax({
				url: '{{ route("getColleges") }}',
				type: 'POST',
				data: {'_token' : $('input[name=_token]').val()},
				success:function(data){
					$("#colleges").html(data);
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
					$("#departments").html(data);
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
					$("#courses").html(data);
				},
			});            
		});
	}
</script>
@endsection