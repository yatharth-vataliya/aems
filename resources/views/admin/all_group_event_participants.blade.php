@extends('layouts.admin_layout')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-responsive table-hover table-condensed table-bordered table-striped">
				@foreach($allGroupEventParticipants as $participantInfo)
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
				<tr class="warning">
					<th>No.</th>
					<th>UNIQUE_ID</th>
					<th>Participant Name</th>
					<th>Mobile No.</th>
					<th>Registration No.</th>
					<th>College</th>
					<th>Department</th>
					<th>Course</th>
				</tr>
				@php
				$no=0;
				@endphp
				@foreach(\App\Models\EventParticipantMember::where(['status'=>'active','unique_id'=>$participantInfo->unique_id])->orderBy('id','ASC')->get() as $participantMemberInfo)
				<tr class="info">
					<td>{{ ++$no }}</td>
					<td>{{ $participantMemberInfo->unique_id }}</td>
					<td>{{ $participantMemberInfo->member_name }}</td>
					<td>{{ $participantMemberInfo->member_mobile }}</td>
					<td>{{ $participantInfo->registration_no }}</td>
					<td>{{ $participantMemberInfo->member_college }}</td>
					<td>{{ $participantMemberInfo->member_department }}</td>
					<td>{{ $participantMemberInfo->member_course }}</td>
				</tr>
				@endforeach
				<tr>
					<td class="danger">Total Fee to pay :-</td><td class="success"><strong>{{ $no * $participantInfo->event_fee }}</strong></td><td></td><td class="danger">Fee Status :-</td><td> @if($participantMemberInfo->member_fee == 'pendding') <a href="{{ route('groupPayFee',['unique_id'=>$participantMemberInfo->unique_id]) }}" class="btn btn-success">Pendding</a> @else <a href="{{ route('groupUndoPayFee',['unique_id'=>$participantMemberInfo->unique_id]) }}" class="btn btn-danger">Undo paid fee</a> @endif </td><td></td><td>Download Event File :-</td>
					<td>
						@if($participantInfo->file == 'not submited')
						<span class="text-danger" >Not Submited</span>
						@endif
						@if(!($participantInfo->file == 'not submited'))
						<a href="{{ route('downloadEventFile',['unique_id'=>$participantInfo->unique_id]) }}" class="btn btn-success">Download</a>
						@endif
					</td>
				</tr>
				<tr>
					<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection