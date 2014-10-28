@extends('admin::layouts.master')

@section('title')
    @parent - Ingame staff
@stop

@section('navbar')
    Accounts
    <small>Ingame staff</small>
@stop

@section('content')
    <div class="row">
         <div class="col-xs-12">
          <div class="box">
             <div class="box-header">
                 <h3 class="box-title">Ingame Staff</h3>
             </div><!-- /.box-header -->
             <div class="box-body table-responsive no-padding">
                 <table class="table table-hover">
                     <tr>
                         <th>Id</th>
                         <th>Account</th>
                         <th>Player</th>
                         <th>Grade</th>
                         <th>Actions</th>
                     </tr>
                     @foreach ($staff as $member)
                     <tr>
                         <td>{{ $member['id'] }}</td>
                         <td>
                            <a href="{{ route('admin.account.edit', array($member['account_id'])) }}">{{ $member['username'] }}</a>
                         </td>
                         <td>{{ $member['player_name'] }}</td>
                         <td>{{ $member['grade'] }}</td>
                         <td>
                              <a class="btn btn-danger" href="{{ route('admin.staff.delete', array($member['id'])) }}">
                                Remove
                              </a>
                         </td>
                     </tr>
                     @endforeach
                 </table>
             </div><!-- /.box-body -->
             <div class="box-footer clearfix">
                 {{-- $accounts->links()--}}
             </div>
         </div><!-- /.box -->
         </div>
    </div>
@stop