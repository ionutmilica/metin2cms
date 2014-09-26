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
        <div class="well account-overview">
            <table width="100%">
                <tr>
                    <th><strong>Username</strong></th>
                    <th>{{ $user->login }}</th>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td><strong>Dragon coin</strong></td>
                    <td>{{ $user->cash }}</td>
                </tr>
                <tr>
                    <td><strong>Dragon marks</strong></td>
                    <td>{{ $user->mileage }}</td>
                </tr>
            </table>
        </div>
    
        <p>
            <div class="list-group">
                <a href="{{ route('account.characters') }}" class="list-group-item active">
                    <h4 class="list-group-item-heading">Character</h4>
                    <p class="list-group-item-text">Display all you characters</p>
                </a>
            </div>
            <div class="list-group">
                <a href="{{ route('account.email') }}" class="list-group-item active">
                    <h4 class="list-group-item-heading">Email</h4>
                    <p class="list-group-item-text">Change email of your account</p>
                </a>
            </div>
            <div class="list-group">
                <a href="{{ route('account.password') }}" class="list-group-item active">
                    <h4 class="list-group-item-heading">Change password</h4>
                    <p class="list-group-item-text">Change password of your account</p>
                </a>
            </div>
            <div class="list-group">
                <a href="{{ route('account.safebox') }}" class="list-group-item active">
                    <h4 class="list-group-item-heading">StoreKeeper</h4>
                    <p class="list-group-item-text">Request StoreKeeper password</p>
                </a>
            </div>
        </p>
    </div>
</div>
@stop