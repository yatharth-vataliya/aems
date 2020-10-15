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
		@foreach($participant_members as $participant)
			<tr>
				<td>{{ ++$no }}</td>
				<td>{{ $participant[0]->unique_id }}</td>
				<td>{{ $participant[0]->email }}</td>
				<td>{{ $participant[0]->name }}</td>
				<td>{{ $participant[0]->college }}</td>
				<td>{{ $participant[0]->department }}</td>
				<td>{{ $participant[0]->course }}</td>
				<td>{{ $participant[0]->mobile }}</td>
				<td>{{ $participant[0]->fee }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>