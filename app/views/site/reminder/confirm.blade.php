@extends('layouts.default')

@section('content')
@include('layouts.partials.alerts')
<div class="panel panel-default">
    <div class="panel-heading">
        Confirm password
    </div>
    <div class="panel-body">
        <div class="alert alert-success">You password has been changed!</div>
    </div>
</div>
@stop