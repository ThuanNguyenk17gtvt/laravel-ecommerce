@if(Session::has('error'))
	<p class="alert alert-danger" > {{Session::get('error')}} </p>
@endif

{{-- @foreach($errors->all() as $error)
	<p class="alert alert-dranger" > {{$error}} </p>
@endforeach --}}

@if(Session::has('success'))
<p class="alert alert-success">{{Session::get('success')}}</p>
@endif