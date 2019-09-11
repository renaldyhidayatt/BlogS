@extends('layouts.app')

@section('content')
    <div class="card card-default">
    <div class="card-header">{{ isset($tags)  ? 'Edit tag' : 'Create tag' }}</div>
    <div class="card-body">
        @include('partials.errors')
    <form action="{{ isset($tag) ? route('tags.update', $tags->id) : route('tags.store')}}" method="post">
            @csrf
            @if (isset($tag))
                @method('PUT')
            @endif
            <div class="md-form">
            Name: <input type="text" class="form-control" name="name" placeholder="Name tags" required value="{{ isset($tags) ? $tags->name : ''}}">
                <small class="form-text text-muted">
                        Gunakan Nama Kategori yang benar oke
                </small>
            </div>
            <div class="md-form">
                    <button type="submit" class="btn btn-outline-success btn-rounded waves-effect"><i class="fas fa-cogs pr-2"
                        aria-hidden="true"></i>{{ isset($tags)  ? 'Update tags' : 'Add tags' }}</button>
            </div>
        </form>
    </div>
@endsection
