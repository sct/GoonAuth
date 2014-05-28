@extends('layouts.main')
@section('content')
<h1>Auth List</h1>
<div class="row">
    <div class="col-md-4">
        <form action="{{ URL::to('admin') }}" method="post" class="form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" value="{{ $search }}">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Search</button>
              </span>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <table class="table">
        <thead>
            <th style="width: 75px;">Status</th>
            <th>SA Username</th>
            <th>Forum Username</th>
            <th style="width: 150px">Controls</th>
        </thead>
        @foreach ($users as $user)
        <tr>
            @if (!empty($user->sa_username))
                <td><span class="label label-success">Goon</span></td>
            @elseif ($user->is_sponsored)
                <td><span class="label label-info">Sponsored</span></td>
            @else
                <td><span class="label label-default">Unauthed</span></td>
            @endif
            @if (empty($user->sa_username))
                <td>N/A</td>
            @else
                <td>{{ $user->sa_username }}</td>
            @endif
            <td>{{ $user->xf_username }}</td>
            <td><a href="{{ URL::to('admin/user/'.$user->id) }}" class="btn btn-primary btn-xs">View User</a></td>
        </tr>
        @endforeach
    </table>
    {{ $users->appends(array('search' => $search))->links(); }}
    </div>
</div>
@stop