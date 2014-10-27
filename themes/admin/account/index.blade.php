@extends('admin::layouts.master')

@section('title')
 @parent - Account list
@stop

@section('scripts')
    @parent
    <script src="{{ assetTheme('js/plugins/datatables/jquery.dataTables.js', 'admin') }}" type="text/javascript"></script>
    <script src="{{ assetTheme('js/plugins/datatables/dataTables.bootstrap.js', 'admin') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $('#accounts').dataTable({
            "bPaginate": true,
            "bInfo": true,
        });
    </script>
@stop

@section('content')
    <div class="row">
         <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Account list</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="accounts" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>ionutxp</td>
                                <td>ionut.milica@gmail.com</td>
                                <td>OK</td>
                                <td>
                                    <a href="account/edit" class="btn btn-success">Edit</a>
                                    <a href="account/block" class="btn btn-danger">Block</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
         </div>
    </div>
@stop