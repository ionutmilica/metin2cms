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
                @if (count($history) == 0)
                    <li>
                        <div class="timeline-item">
                            No history data for this user !
                        </div>
                    </li>
                @else
                @foreach($history as $event)
                    <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fa fa-clock-o"></i>
                                {{ Carbon\Carbon::parse($event['created_at'])->diffForHumans() }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="{{ route('admin.account.edit', $event['account_id']) }}">
                                    {{ $event['account_name']  }}
                                </a>
                                {{ $event['event_type'] }} {{-- Here we'll add language func --}}
                            </h3>
                            @if ($event['data'] !== '')
                            <div class="timeline-body">
                                 {{ $event['data'] }}
                            </div>
                            @endif
                            <div class="timeline-footer">
                                <a href="{{ route('admin.account.edit', $event['account_id']) }}" class="btn btn-primary btn-xs">Edit account</a>
                                @if ($event['event_type'] != 'blocked')
                                    <a href="{{ route('admin.account.block', $event['account_id']) }}" class="btn btn-danger btn-xs">Block account</a>
                                @else
                                    <a href="{{ route('admin.account.unblock', $event['account_id']) }}" class="btn btn-success btn-xs">Unblock account</a>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
@stop