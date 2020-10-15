@if ($errors->any())
<div class="alert alert-danger alert-dismissable">
	<ul>
		@foreach ($errors->all() as $error)
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif