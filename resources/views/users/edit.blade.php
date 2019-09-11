@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        My Profile
    </div>
    <div class="card-body">
        @include('partials.errors')
    <form action="{{ route('users.update-profile')}}" method="POST">
        @csrf
        @method('PUT')
        <div class="md-form">
            <i class="fas fa-user"></i> Name
            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="about">About Me</label>
            <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{ $user->about }}</textarea>
        </div>
        <button type="submit" class="btn btn-outline-success waves-effect"><i class="fas fa-user"></i>Update Profile</button>
    </form>
    </div>
</div>
@endsection
