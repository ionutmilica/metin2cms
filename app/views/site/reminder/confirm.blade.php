@extends('layouts.default')

@section('content')
@include('layouts.partials.alerts')
<div class="panel panel-default">
    <div class="panel-heading">
        Enter the new password
    </div>
    <div class="panel-body">
        <form role="form" action="{{ route('account.login') }}" method="post">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Repeat the password</label>
                <input type="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Change it</button>
        </form>
    </div>
</div>
@stop