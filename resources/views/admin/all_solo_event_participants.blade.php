@extends('layouts.admin_layout')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-responsive table-hover table-condensed table-bordered table-striped">
				<tr>
					<th>No.</th>
					<th>UNIQUE_ID</th>
					<th>Participant Name</th>
					<th>Mobile No.</th>
					<th>Registration No.</th>
					<th>College</th>
					<th>Department</th>
					<th>Course</th>
					<th>Event Fees</th>
					<th>Certificate</th>
				</tr>
				@php
				$no=0;
				@endphp
				@foreach($allSoloEventParticipants as $participantInfo)
				<tr class="danger">
					<th>Event Name</th>
					<th>Event Type</th>
					<th>Participant Limit</th>
					<th>Event Start Date</th>
					<th>Event End Date</th>
					<th>Event Fee</th>
					<th>Event Venue</th>
				</tr>
				<tr class="success">
					<td>{{ $participantInfo->event_name }}</td>
					<td>{{ $participantInfo->event_type }}</td>
					<td>{{ $participantInfo->event_participant_limit }}</td>
					<td>{{ $participantInfo->event_start_date }}</td>
					<td>{{ $participantInfo->event_end_date }}</td>
					<td>{{ $participantInfo->event_fee }}</td>
					<td>{{ $participantInfo->event_venue }}</td>
				</tr>
				<tr class="info">
					<td>{{ ++$no }}</td>
					<td>{{ $participantInfo->unique_id }}</td>
					<td>{{ $participantInfo->name }}</td>
					<td>{{ $participantInfo->mobile }}</td>
					<td>{{ $participantInfo->registration_no }}</td>
					<td>{{ $participantInfo->college }}</td>
					<td>{{ $participantInfo->department }}</td>
					<td>{{ $participantInfo->course }}</td>
					@if($participantInfo->fee == 'pendding')
						<td><a href="{{ route('soloPayFee',['unique_id'=>$participantInfo->unique_id]) }}" class="btn btn-default">Pendding</a></td>
					@else
						<td><a href="{{ route('soloUndoPayFee',['unique_id'=>$participantInfo->unique_id]) }}" class="btn btn-danger">Undo paid fees</a></td>
					@endif
					<td>{{ $participantInfo->certificate }}</td>
				</tr>
				<tr>
					<td>Download Event File :-</td>
					<td>
						@if($participantInfo->file == 'not submited')
							<span class="text-danger" >Not Submited</span>
						@endif
						@if(!($participantInfo->file == 'not submited'))
							<a href="{{ route('downloadEventFile',['unique_id'=>$participantInfo->unique_id]) }}" class="btn btn-success">Download</a>
						@endif
						</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 text-center">
			{{ $allSoloEventParticipants->links() }}
		</div>
	</div>
</div>
@endsection