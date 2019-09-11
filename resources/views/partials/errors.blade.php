@if($errors->any())
    <div class="alert alert-danger">
        <u class="list-group">
            @foreach($errors->all() as $error)
            <li class="list-group-item text-danger"> {{$error}}</li>
            @endforeach
        </u>
    </div>
@endif
