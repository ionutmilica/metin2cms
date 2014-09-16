@extends('layouts.default')

@section('content')
@include('layouts.partials.alerts')

<form role="form" action="{{ route('account.create') }}" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="username" class="form-control" name="username" id="username" placeholder="Enter username">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Password Confirmation</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password">
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox"> I accept the terms
        </label>
    </div>
    <button type="submit" class="btn btn-primary">Create account</button>
</form>
@stop