@extends('layouts.main')
@section('content')
<h1>Sponsor List</h1>
<div class="row">
    <div class="col-md-12">
    @if ($auth->sponsors->count() == 0)
    <p>You currently have no sponsored accounts registered.</p>
    <p><a href="{{ URL::to('sponsor/add') }}" class="btn btn-success">Sponsor a Friend</a></p>
    @else
    <p>Your registered sponsors are below. You currently have <strong>{{ $auth->sponsors->count() }}/{{ Config::get('goonauth.sponsors') }}</strong> sponsors registered.</p>  
    <table class="table">
        <thead>
            <th>Sponsor Name</th>
        </thead>
        @foreach ($auth->sponsors as $sponsor)
        <tr>
            <td>{{ $sponsor->xf_username }}</td>
        </tr>
        @endforeach
    </table>
    @if ($auth->characters->count() >= Config::get('goonauth.characters'))
    <p><a href="#" class="btn btn-success" disabled>Max Characters Reached</a></p>
    @else
    <p><a href="{{ URL::to('sponsor/add') }}" class="btn btn-success">Add Sponsor</a></p>
    @endif
    @endif
    </div>
</div>
@stop