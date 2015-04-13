@extends('standard::layouts.default')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Change you email
    </div>
    <div class="panel-body">
        @include('standard::layouts.partials.global_error')
        <form role="form" action="{{ route('account.email') }}" method="post">
            {!! Form::token() !!}
            <div class="form-group @if ($errors->has('old_email')) has-error @endif">
                <label for="old_email">Old email address</label>
                <input type="email" class="form-control" name="old_email" id="old_email" placeholder="Enter your old email">
                @if ($errors->has('old_email'))
                <span class="help-block">{{ $errors->first('old_email') }} </span>
                @endif
            </div>
            <div class="form-group @if ($errors->has('new_email')) has-error @endif">
                <label for="new_email">New email address</label>
                <input type="email" class="form-control" name="new_email" id="new_email" placeholder="Enter your new email">
                @if ($errors->has('new_email'))
                    <span class="help-block">{{ $errors->first('new_email') }} </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Change email</button>
        </form>
    </div>
</div>
@stop