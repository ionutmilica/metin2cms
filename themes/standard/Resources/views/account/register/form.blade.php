@extends('standard::layouts.default')

@section('title')
   Account creation - @parent
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Register account
    </div>
    <div class="panel-body">
        @include('standard::layouts.partials.global_error')
        <form role="form" action="{{ route('account.register') }}" method="post">
            {!! Form::token() !!}
            <div class="form-group @if ($errors->has('username')) has-error @endif">
                <label for="username">Username</label>
                <input type="username" class="form-control" name="username" id="username" placeholder="Enter username">
                @if ($errors->has('username'))
                    <span class="help-block">{{ $errors->first('username') }} </span>
                @endif
            </div>
            <div class="form-group @if ($errors->has('email')) has-error @endif">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }} </span>
                @endif
            </div>
            <div class="form-group @if ($errors->has('password')) has-error @endif">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }} </span>
                @endif
            </div>
            <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">{{ $errors->first('password_confirmation') }} </span>
                @endif
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> I accept the terms
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Create account</button>
        </form>
    </div>
</div>
@stop