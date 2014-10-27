@extends('admin::layouts.master')

@section('title')
    @parent - Edit account
@stop

@section('navbar')
    Accounts
    <small>Edit account</small>
@stop

@section('content')
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit <strong>{{ $account['login'] }}</strong> Account</h3>
            </div><!-- /.box-header -->

            <form role="form">
                <div class="box-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Enter email" id="username" class="form-control" value="{{ $account['login'] }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" placeholder="Enter email" id="email" class="form-control" value="{{ $account['email'] }}">
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Edit account</button>
                </div>
            </form>
        </div><!-- /.box -->
    </div>
@stop