@extends('layouts.admin_layout')

@section('content')
<div class="col-md-4">
	<a href="{{ route('college.create') }}" class="btn btn-primary">Add College, Department Or Course</a>
</div>
<div class="col-md-4"></div>
<div class="col-md-4"></div>
<div class="col-md-12">
	<table class="table table-bordered table-hover table-responsive table-striped">
		<tr>
			<th>No.</th>
			<th>College Name</th>
			<th>Department Name</th>
			<th>Course Name</th>
			<th>Status</th>
		</tr>
		@php
		$no=1;
		@endphp
		@foreach($colleges as $college)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $college->college_name }}</td>
			<td>{{ $college->department }}</td>
			<td>{{ $college->course }}</td>
			@if($college->status == 'active')
				<td><a class="btn btn-success" href="{{ route('college.edit',['id'=>$college->id]) }}">Active</a></td>
			@else
				<td><a class="btn btn-danger" href="{{ route('college.edit',['id'=>$college->id]) }}">Deactive</a></td>
			@endif
		</tr>
		@endforeach
	</table>
</div>
<div class="col-md-6 col-md-offset-2 text-center">{{ $colleges->links() }}</div>
@endsection