@extends('layouts.default')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Recover your password
    </div>
    <div class="panel-body">
        @include('layouts.partials.global_error')
        <form role="form" action="{{ route('account.password-reset') }}" method="post">
            {{ Form::token() }}
            <div class="form-group @if ($errors->has('username')) has-error @endif">
                <label for="username">Username</label>
                <input type="username" class="form-control" name="username" id="username" placeholder="Enter username">
                @if ($errors->has('username'))
                    <span class="help-block">{{ $errors->first('username') }} </span>
                @endif
            </div>
            <div class="form-group @if ($errors->has('email')) has-error @endif">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }} </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Recover password</button>
        </form>
    </div>
</div>
@stop