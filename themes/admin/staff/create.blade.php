@extends('admin::layouts.master')

@section('title')
    @parent - Add to staff
@stop

@section('navbar')
    Accounts
    <small>Add to staff</small>
@stop

@section('content')
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add to staff</h3>
            </div><!-- /.box-header -->

            <form role="form" method="post" action="{{ route('admin.staff.create') }}">
                <div class="box-body">
                    <div class="form-group @if ($errors->has('account')) has-error @endif">
                        <label for="account">Account name</label>
                        <input type="text" name="account" placeholder="Account name" id="account" class="form-control">
                        @if ($errors->has('account'))
                            <span class="help-block">{{ $errors->first('account') }} </span>
                        @endif
                    </div>
                    <div class="form-group @if ($errors->has('player')) has-error @endif">
                        <label for="player">Player name</label>
                        <input type="player" name="player" placeholder="Player name" id="player" class="form-control">
                        @if ($errors->has('player'))
                            <span class="help-block">{{ $errors->first('player') }} </span>
                        @endif
                    </div>
                    <div class="form-group @if ($errors->has('grade')) has-error @endif">
                        <label for="grade">Staff grade</label>
                        <select name="grade" class="form-control">
                            <option value="IMPLEMENTOR">IMPLEMENTOR</option>
                            <option value="HIGH_WIZARD">HIGH WIZARD</option>
                            <option value="GOD">GOD</option>
                            <option value="LOW_WIZARD">LOW WIZARD</option>
                        </select>
                        @if ($errors->has('grade'))
                            <span class="help-block">{{ $errors->first('grade') }} </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Create member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop