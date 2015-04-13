@extends('standard::layouts.default')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Character deletion code
    </div>
    <div class="panel-body">
        @include('standard::layouts.partials.global_error')
        Due to security reasons and to avoid missconduct, you can only delete a character with the input of a specific code
        <form role="form" action="{{ route('account.deletion_code') }}" method="post">
            {!! Form::token() !!}
            <button type="submit" class="btn btn-primary">Send deletion code</button>
        </form>
    </div>
</div>
@stop