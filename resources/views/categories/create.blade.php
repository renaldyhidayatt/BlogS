@extends('layouts.app')

@section('content')
    <div class="card card-default">
    <div class="card-header">{{ isset($category)  ? 'Edit Category' : 'Create category' }}</div>
    <div class="card-body">
        @include('partials.errors')
    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store')}}" method="post">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif
            <div class="md-form">
            Name: <input type="text" class="form-control" name="name" placeholder="Name Category" required value="{{ isset($category) ? $category->name : ''}}">
                <small class="form-text text-muted">
                        Gunakan Nama Kategori yang benar oke
                </small>
            </div>
            <div class="md-form">
                    <button type="submit" class="btn btn-outline-success btn-rounded waves-effect"><i class="fas fa-cogs pr-2"
                        aria-hidden="true"></i>{{ isset($category)  ? 'Update Category' : 'Add category' }}</button>
            </div>
        </form>
    </div>
@endsection
