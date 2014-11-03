@extends('admin::layouts.master')

@section('title')
    @parent - Player list
@stop

@section('navbar')
    Players
    <small>List of players</small>
@stop

@section('content')
    <div class="row">
         <div class="col-xs-12">
          <div class="box">
             <div class="box-header">
                 <h3 class="box-title">Players</h3>
                 <div class="box-tools">
                 <form action="{{ route('admin.player.index') }}" method="get">
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
                         <th>Name</th>
                         <th>Account</th>
                         <th>Level</th>
                         <th>Gold</th>
                     </tr>
                     <?php $players = array(); ?>
                     @foreach ($players as $player)
                     <tr>
                         <td>{{ $player['id'] }}</td>
                         <td>{{ $player['name'] }}</td>
                         <td>{{ $player['account_id'] }}</td>
                         <td>{{ $player['level'] }}</td>
                         <td>{{ $player['gold'] }}</td>
                     </tr>
                     @endforeach
                 </table>
             </div><!-- /.box-body -->
             <div class="box-footer clearfix">
                 {{-- $players->links() --}}
             </div>
         </div><!-- /.box -->
         </div>
    </div>
@stop