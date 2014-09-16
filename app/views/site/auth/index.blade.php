@extends('layouts.default')

@section('content')
@include('layouts.partials.alerts')

<form role="form" action="{{ route('account.login') }}" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="username" class="form-control" name="username" id="username" placeholder="Enter username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox"> Keep me logged
        </label>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
@stop