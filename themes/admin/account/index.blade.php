@extends('admin::layouts.master')

@section('title')
    @parent - Account list
@stop

@section('navbar')
    Accounts
    <small>List of accounts</small>
@stop

@section('content')
    <div class="row">
         <div class="col-xs-12">
          <div class="box">
             <div class="box-header">
                 <h3 class="box-title">Conturi</h3>
                 <div class="box-tools">
                 <form action="{{ route('admin.account.index') }}" method="get">
                     <div class="input-group">
                         <input type="text" name="username" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                         <div class="input-group-btn">
                             <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                         </div>
                     </div>
                  </form>
                 </div>
             </div><!-- /.box-header -->
             <div class="box-body table-responsive no-padding">
                 <table class="table table-hover">
                     <tr>
                         <th>Id</th>
                         <th>Username</th>
                         <th>Email</th>
                         <th>Status</th>
                         <th>Actions</th>
                     </tr>
                     @foreach ($accounts as $account)
                     <tr>
                         <td>{{ $account['id'] }}</td>
                         <td>{{ $account['username'] }}</td>
                         <td>{{ $account['email'] }}</td>
                         <td>
                            <span class="label label-@if ($account['status'] == 'OK')success @else danger @endif">{{ $account['status'] }}</span>
                         </td>
                         <td>
                            <a class="btn btn-success" href="{{ route('admin.account.edit', array($account['id'])) }}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('admin.account.block', array($account['id'])) }}">Block</a>
                         </td>
                     </tr>
                     @endforeach
                 </table>
             </div><!-- /.box-body -->
             <div class="box-footer clearfix">
                 {{ $accounts->links() }}
             </div>
         </div><!-- /.box -->
         </div>
    </div>
@stop