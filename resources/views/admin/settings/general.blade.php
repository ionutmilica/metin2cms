@extends('admin::layouts.master')

@section('title')
    @parent - General settings
@stop

@section('navbar')
    Settings
    <small>General settings</small>
@stop

@section('content')
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Current theme</h3>
            </div><!-- /.box-header -->

            <form role="form" method="post" action="{{ '' }}">
                <div class="box-body">
                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                        <label for="theme">Themes:</label>
                        <select id="theme" name="theme">
                            @foreach ($themes as $theme)
                                <option value="{{ $theme['name'] }}" @if($current == $theme['name']) selected @endif>{{ $theme['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Change</button>
                </div><!-- /.box-body -->
            </form>
        </div>
    </div>
@stop