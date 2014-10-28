@extends('admin::layouts.master')

@section('title')
    @parent - Block account
@stop

@section('styles')
    @parent
     <link href="{{ assetTheme('css/datetimepicker/jquery.datetimepicker.css', 'admin') }}" rel="stylesheet"/>
@stop

@section('scripts')
    @parent
     <script type="text/javascript" src="{{ assetTheme('js/plugins/datetimepicker/jquery.datetimepicker.js', 'admin') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#expiration').datetimepicker();
        });
    </script>
@stop

@section('navbar')
    Accounts
    <small>Block account</small>
@stop

@section('content')
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Block <strong>{{ $account['login'] }}</strong></h3>
            </div><!-- /.box-header -->

            <form role="form" method="post" action="{{ route('admin.account.block', $id) }}">
                <div class="box-body">
                    <div class="form-group @if ($errors->has('reason')) has-error @endif">
                        <label for="reason">Reason</label>
                        <input type="text" name="reason" placeholder="Enter reason" id="reason" class="form-control">
                        @if ($errors->has('reason'))
                            <span class="help-block">{{ $errors->first('reason') }} </span>
                        @endif
                    </div>
                    <div class="form-group @if ($errors->has('expiration')) has-error @endif">
                        <label for="expiration">Expiration</label>
                        <input type="expiration" name="expiration" placeholder="Enter expiration" id="expiration" class="form-control">
                        @if ($errors->has('expiration'))
                            <span class="help-block">{{ $errors->first('expiration') }} </span>
                        @endif
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Block</button>
                </div>
            </form>
        </div><!-- /.box -->
    </div>
@stop