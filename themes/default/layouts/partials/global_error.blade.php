@if ($errors->has('global'))
<div class="alert alert-danger alert-error">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <ul><li>{{ $errors->first('global') }}</li> </ul>
</div>
@endif