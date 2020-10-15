@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 alert-danger">
			<h2>{{ $exception->getMessage() }}</h2>
		</div>
		<div class="col-md-2">
			<a href="{{ route('home') }}" class="btn btn-primary">Home</a>
		</div>
	</div>
</div>

@endsection