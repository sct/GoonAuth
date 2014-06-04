@extends('layouts.main')
@section('content')
<div class="row">
  <div class="col-md-12">
    <p>Welcome to the {{ Config::get('goonauth.title') }}! To get started, login using your forum account below. If you're already registered and you're here then you probably know what you need to do. Authenticating your account here will give you access to all guild forums and viewing and editing privileges on the wiki.</p>
    <p>Currently we're only accepting recruits that have been SA members for <strong>at least 90 days</strong>. If you want an exception to this policy... too bad.</p>
  </div>
</div>

<form class="form-signin" role="form" action="{{ URL::to('login') }}" method="post">
  <h2 class="form-signin-heading">Login using forum account</h2>
  @if (Session::has('error'))
    <div class="alert alert-danger">
    {{ Session::get('error') }}
    </div>
  @endif
  <input type="text" name="username" class="form-control" placeholder="Email address/Username" required="" autofocus="">
  <input type="password" name="password" class="form-control" placeholder="Password" required="">
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
@stop