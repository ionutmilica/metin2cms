@if ($errors->has('global'))
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    {{ $errors->first('global') }}
</div>
@endif