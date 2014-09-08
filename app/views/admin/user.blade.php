@extends('layouts.main')
@section('content')
<h1>Forum Name: {{ $user->xf_username }} / SA Username: {{ !empty($user->sa_username) ? $user->sa_username : "N/A" }}</h1>
<div class="row">
    <div class="col-md-12">
    <p><strong>Account Status:</strong> 
    @if (!empty($user->sa_username))
        <span class="label label-success">Authed</span>
    @elseif ($user->is_sponsored)
        <span class="label label-info">Sponsored</span> by <strong>{{ HTML::link('admin/user/'.$user->sponsoree()->first()->id, $user->sponsoree()->first()->sa_username) }}</strong>
    @else
        <span class="label label-default">Unauthed</span>
    @endif
    </p>
    @if (!empty($user->sa_username) || $user->is_sponsored)
    <p><strong>Linked:</strong> {{ Carbon::createFromFormat('Y-m-d H:i:s', $user->linked_at)->toDateString() }}
    @endif
    @if (!empty($user->sa_username))
    <p><strong>SA Profile:</strong> {{ HTML::link('http://forums.somethingawful.com/member.php?action=getinfo&username='.$user->sa_username, 'Click Here', array('target' => '_blank')) }}</p>
    @endif
    <p><strong>Characters:</strong></p>
    <ul>
    @foreach ($user->characters as $character)
        <li>{{ $character->name }} {{ $character->is_main ? '<span class="label label-primary">Main</span>' : '' }}</li>
    @endforeach
    </ul>
    @if (!empty($user->sa_username))
    <p><strong>Sponsored Accounts:</strong></p>
    <ul>
    @foreach ($user->sponsors as $sponsor)
        <li>{{ $sponsor->xf_username }}</li>
    @endforeach
    </ul>
    @endif
    @if (in_array(Session::get('auth')->id, Config::get('goonauth.superAdmins')))
        @if (!$user->is_admin)
        <p><a href="{{ URL::to('admin/user/1?admin=1') }}" class="label label-primary">Set as admin</a></p>
        @else
        <p><a href="{{ URL::to('admin/user/1?admin=0') }}" class="label label-danger">Remove Admin</a></p>
        @endif
    @endif
    </div>

</div>
@stop