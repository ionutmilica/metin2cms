@extends('layouts.default')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Change you email
    </div>
    <div class="panel-body">
        @include('layouts.partials.global_error')
        <form role="form" action="{{ route('account.email') }}" method="post">
            <div class="form-group @if ($errors->has('email')) has-error @endif">
                <label for="email">New email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }} </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Change email</button>
        </form>
    </div>
</div>
@stop