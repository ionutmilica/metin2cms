@extends('standard::layouts.default')

@section('title')
    Account authentication - @parent
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Login
    </div>
    <div class="panel-body">
        @include('standard::layouts.partials.global_error')
        <form role="form" action="{{ route('account.login') }}" method="post">
            {!! Form::token() !!}
            <div class="form-group @if ($errors->has('username')) has-error @endif">
                <label for="username">Username</label>
                <input type="username" class="form-control" name="username" id="username" placeholder="Enter username">
                @if ($errors->has('username'))
                    <span class="help-block">{{ $errors->first('username') }} </span>
                @endif
            </div>
            <div class="form-group @if ($errors->has('password')) has-error @endif">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }} </span>
                @endif
            </div>
            <div class="checkbox">
                <label>
                    <input id="remember" name="remember" type="checkbox"> Remember me
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>
@stop