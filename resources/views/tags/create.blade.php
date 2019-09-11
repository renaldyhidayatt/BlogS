@extends('layouts.app')

@section('content')
<div class="card card-default">
  <div class="card-header">
    {{ isset($tag)  ? 'Edit Tag' : 'Create Tag' }}
  </div>
  <div class="card-body">
    @include('partials.errors')
    <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
      @csrf
      @if(isset($tag))
        @method('PUT')
      @endif
      <div class="md-form">
            Name: <input type="text" class="form-control" name="name" placeholder="Name tags" required value="{{ isset($tag) ? $tag->name : ''}}">
                <small class="form-text text-muted">
                        Gunakan Nama Tags yang benar oke
                </small>
            </div>
            <div class="md-form">
                <button type="submit" class="btn btn-outline-success btn-rounded waves-effect"><i class="fas fa-cogs pr-2" aria-hidden="true"></i>{{ isset($tag)  ? 'Update Tag' : 'Add Tag' }}</button>
            </div>
    </form>
  </div>
</div>
@endsection
