@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="authed">
			<i class="fa fa-check-circle"></i>
			@if (!$auth->is_sponsored)
			<h2>You are authed!</h2>
			<p>Your forum account is linked to the SA Account <strong>{{ $auth->sa_username }}</strong>.</p>
			<p>You have <strong>{{ $auth->characters->count() }}/{{ Config::get('goonauth.characters') }}</strong> registered characters.</p>
			<p>You have <strong>{{ $auth->sponsors->count() }}/{{ Config::get('goonauth.sponsors') }}</strong> sponsorships.</p>
			<p>To get a character invited to the guild you need to add your character to this system. If you want to sponsor a friend click the sponsor button.</p>
			<a href="{{ URL::to('characters') }}" class="btn btn-lg btn-success">Add Characters</a> <a href="{{ URL::to('sponsors') }}" class="btn btn-lg btn-primary">Sponsor a Friend</a>
			@else
			<h2>You are sponsored!</h2>
			<p>You were sponsored by <strong>{{ $auth->sponsoree()->first()->sa_username }}</strong>.</p>
			<p>You have <strong>{{ $auth->characters->count() }}/{{ Config::get('goonauth.sponsored') }}</strong> registered characters.</p>
			<p>To get a character invited to the guild you need to add your character to this system.</p>
			<a href="{{ URL::to('characters') }}" class="btn btn-lg btn-success">Add Characters</a>
			@endif
		</div>
	</div>
</div>
@stop