@extends('admin::layouts.master')

@section('title')
    @parent - Account History
@stop

@section('navbar')
    History
    <small>History of account</small>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">
                @foreach($history as $event)
                    <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> {{ Carbon::parse($event['created_at'])->diffForHumans() }}</span>
                            <h3 class="timeline-header"><a href="#">Dev</a> account confirmed</h3>
                            <div class="timeline-body">
                                @if ($event['event_type'] == 'unblocked') Unblocked @else {{ $event['data'] }} @endif
                            </div>
                            <div class="timeline-footer">
                                <a href="{{ route('admin.account.edit', $event['account_id']) }}" class="btn btn-primary btn-xs">Edit account</a>
                                <a href="{{ route('admin.account.block', $event['account_id']) }}" class="btn btn-danger btn-xs">Block account</a>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div><!-- /.col -->
    </div>
@stop