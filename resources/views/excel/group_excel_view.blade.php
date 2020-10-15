<!DOCTYPE html>
<html>
<head>
	<title>Excel View</title>
</head>
<body>
<table border="5px">
	<thead>
		<tr>
			<th>Event Name</th>
			<th>Event Type</th>
			<th>Event Participant Limit</th>
			<th>Event Fee</th>
			<th>Event Start Date</th>
			<th>Event End Date</th>
			<th>Event Venue</th>
		</tr>
		<tr>
			<td>{{ $event_info->event_name }}</td>
			<td>{{ $event_info->event_type }}</td>
			<td>{{ $event_info->event_participant_limit }}</td>
			<td>{{ $event_info->event_fee }}</td>
			<td>{{ $event_info->event_start_date }}</td>
			<td>{{ $event_info->event_end_date }}</td>
			<td>{{ $event_info->event_venue }}</td>
		</tr>
		<tr>
			<th>No.</th>
			<th>UNIQUE_ID</th>
			<th>Email</th>
			<th>Name</th>
			<th>College</th>
			<th>Deptartment</th>
			<th>Course</th>
			<th>Contact</th>
			<th>Fees</th>
		</tr>
	</thead>
	<tbody>
		@php 
		$no=0;
		@endphp
		@if(!empty($participant_members[0]))
		@foreach($participant_members[0] as $participant)
			<tr>
				<td>{{ ++$no }}</td>
				<td>{{ $participant->unique_id }}</td>
				<td>{{ $participant->member_email }}</td>
				<td>{{ $participant->member_name }}</td>
				<td>{{ $participant->member_college }}</td>
				<td>{{ $participant->member_department }}</td>
				<td>{{ $participant->member_course }}</td>
				<td>{{ $participant->member_mobile }}</td>
				<td>{{ $participant->member_fee }}</td>
			</tr>
		@endforeach
		@endif
	</tbody>
</table>
</body>
</html>