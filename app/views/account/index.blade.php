@extends('layouts.default')

@section('title')
Account overview - @parent
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Your account
    </div>
    <div class="panel-body">
        <p>Username: {{ $user->login }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Dragon coins: {{ $user->cash }}</p>
        <p>Dragon marks: {{ $user->mileage }}</p>
        <ul>
            <!-- Make routes and controller actions -->
            <li><a href="/account/characters">Character</a></li>
            <li><a href="/account/email">Email</a></li>
            <li><a href="/account/password">Password reset</a></li>
            <li><a href="/account/storage">Storage password</a></li>
        </ul>
    </div>
</div>
@stop