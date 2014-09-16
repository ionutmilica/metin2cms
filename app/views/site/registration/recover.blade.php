@extends('layouts.default')

@section('content')
@include('layouts.partials.alerts')

<form role="form" action="{{ route('account.recover') }}" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="username" class="form-control" name="username" id="username" placeholder="Enter username">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
    </div>
    <button type="submit" class="btn btn-primary">Recover password</button>
</form>
@stop