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
<div class="col-md-4 alert-warning text-center"><h1>INSERT COLLEGE</h1></div>
<div class="col-md-4">
	<a href="{{ route('college.index') }}" class="btn btn-primary">Home</a>
</div>
<div class="col-md-12" style="padding-top: 10px;">
	<form class="form-horizontal" action="{{ route('college.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-group">
			<label class="control-label col-md-4">College Name:-</label>
			<div class="col-md-4">
				<input type="text" name="college_name" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-4">Department Name:-</label>
			<div class="col-md-4">
				<input type="text" name="department" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-4">Course Name:-</label>
			<div class="col-md-4">
				<input type="text" name="course[]" class="form-control" required>
				<div id="course"></div>
			</div>
			<div class="col-md-2">
				<button type="button" onclick="addCourse()" class="btn btn-success">Add Course</button>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-4 col-md-4">
				<input type="submit" name="submit" value="Submit" class="col-md-4  btn btn-primary">
			</div>
		</div>
	</form>
</div>
@endsection
@section('script')
<script>
	var count=1;
	function addCourse(){
		document.getElementById("course").innerHTML+='<div style="padding-top:5px;" id="'+count+'"><input type="text" name="course[]" class="form-control" required><button type="button" onclick="removeCourse(this.value)" value="'+count+'" class="btn btn-danger">Remove Course</button></div>';
		count++;
	}
	function removeCourse(value){
		var del=value;
		document.getElementById(del).innerHTML='';
	}
</script>
@endsection