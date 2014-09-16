@if (count($errors->all()) > 0)
<div class="alert alert-danger alert-error">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif