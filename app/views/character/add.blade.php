@extends('layouts.main')
@section('content')
<h1>Add Character</h1>
<div class="row">
        <div class="col-md-12">
        @if ($auth->characters->count() == 0)
        <p>Since this is the first character you are adding it will be considered the <strong>main</strong> of your account. This can be changed later. In the event we cannot invite alts to the guild for whatever reason, only your <strong>main character will be invited!</strong></p>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">
        	{{ Session::get('error') }}
        </div>
        @endif
        <form action="{{ URL::to('character/add') }}" method="post" class="form">
        	<div class="form-group">
        		<input type="text" name="name" class="form-control" placeholder="Character Name">
        	</div>
        	<div class="form-group">
        		<button type="submit" class="btn btn-primary">Add Character</button>
        	</div>
        </form>
        </div>
</div>
@stop