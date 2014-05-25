@extends('layouts.main')
@section('content')
<h1>Character List</h1>
<div class="row">
    <div class="col-md-12">
    @if ($auth->characters->count() == 0)
    <p>You currently do not have a main character added. Add your main character to be invited into the guild.</p>
    <p><a href="{{ URL::to('character/add') }}" class="btn btn-success">Add Main Character</a></p>
    @else
    @if ($auth->is_sponsored)
    <p>Your registered characters are below. You currently have <strong>{{ $auth->characters->count() }}/{{ Config::get('goonauth.sponsored') }}</strong> characters registered.</p>
    @else
    <p>Your registered characters are below. You currently have <strong>{{ $auth->characters->count() }}/{{ Config::get('goonauth.characters') }}</strong> characters registered.</p>
    @endif
    <table class="table">
        <thead>
            <th style="width: 75px;">Status</th>
            <th>Character Name</th>
            <th style="width: 150px">Controls</th>
        </thead>
        @foreach ($auth->characters as $character)
        <tr>
            <td>{{ $character->is_main ? '<span class="label label-primary">Main</span>' : '<span class="label label-default">Alt</span>' }}</td>
            <td>{{ $character->name }}</td>
            <td>{{ $character->is_main ? '<a href="#" class="btn btn-primary btn-xs" disabled>Set As Main</a>' : '<a href="' . URL::to('character/main/'.$character->id) . '" class="btn btn-primary btn-xs">Set As Main</a>' }} <a href="{{ URL::to('character/delete/'.$character->id) }}" class="btn btn-danger btn-xs">Delete</a></td>
        </tr>
        @endforeach
    </table>
    @if (($auth->characters->count() >= Config::get('goonauth.characters') && !$auth->is_sponsored) || ($auth->is_sponsored && $auth->characters->count() >= Config::get('goonauth.sponsored'))) 
    <p><a href="#" class="btn btn-success" disabled>Max Characters Reached</a></p>
    @else
    <p><a href="{{ URL::to('character/add') }}" class="btn btn-success">Add Alt</a></p>
    @endif
    @endif
    </div>
</div>
@stop