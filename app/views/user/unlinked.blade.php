@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="not-authed">
			<i class="fa fa-exclamation-circle"></i>
			<h2>You are not authed!</h2>
			<p>Congratulations! You figured out how to log in with your forum account. Now you need to link your forum account with your SA account. This is really easy to do if you aren't literally hitler but actually he can probably even do it. (That is if he knew how to use computers. I am unsure if he knows how to use computers)</p>
			<p><strong>If you are waiting to be sponsored you don't have to do anything. Just have your friend sponsor you and you will get access to this system.</strong></p>
			<a href="{{ URL::to('link') }}" class="btn btn-lg btn-danger">Link Your SA Account</a>
		</div>
	</div>
</div>
@stop