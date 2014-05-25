@extends('layouts.main')
@section('content')
<h1>Link Your Account</h1>
<div class="row">
	<div class="col-md-12">
		<p>Go <a href="http://forums.somethingawful.com/member.php?action=editprofile" target="_blank">edit your profile</a> on SA and place the token below in any of the public fields, ie. about me, location, interests, etc. Once you've done that, enter your username and click the link button.</p>
        <p><strong>Authentication Token</strong>: <kbd>{{ $token }}</kbd></p>
        <h3>Enter your SA Account Name</h3>
        @if (Session::has('error'))
        <div class="alert alert-danger">
        	{{ Session::get('error') }}
        </div>
        @endif
        <form action="{{ URL::to('link') }}" method="post" class="form">
        	<div class="form-group">
        		<input type="text" name="sa_username" class="form-control" placeholder="SA Username">
        	</div>
        	<div class="form-group">
        		<button type="submit" class="btn btn-primary">Link Account</button>
        	</div>
        </form>
	</div>
</div>
@stop