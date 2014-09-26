@extends('layouts.default')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Storekeeper password
    </div>
    <div class="panel-body">
        You can have your Storekeeper password sent to you via e-mail here.
        @include('layouts.partials.global_error')
        <form role="form" action="{{ route('account.safebox') }}" method="post">
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>
@stop