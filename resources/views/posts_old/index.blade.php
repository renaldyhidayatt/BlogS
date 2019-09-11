@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create')}}" class="btn btn-outline-success btn-rounded waves-effect"><i class="fa fa-list-alt" aria-hidden="true"></i> Add Posts</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
            @if ($posts->count() > 0)
            <table class="table">
                <thead>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($posts as $p)
                    <tr>
                        <td>
                            <img src="{{ $p->image }}" width="120px" height="120px">
                        </td>
                        <td>
                            {{ $p->title }}
                        </td>
                        <td><a href="{{ route('categories.edit', $p->category->id )}}">
                            {{ $p->category->name }}
                        </a>
                        </td>
                        @if($p->trashed())
                        <td>
                            <form action="{{ route('restore-posts', $$p->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            <button type="submit" class="btn btn-info btn-sm">Restore</button>
                            </form>
                        </td>
                        @else
                        <td>
                            <a href="{{ route('posts.edit', $p->id) }}" class="btn btn-info btn-sm">Edit</a>
                        </td>
                        @endif
                        <td>
                        <form action="{{ route('posts.destroy', $p->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                            {{ $post->trashed() ? 'Delete': 'Trash' }}
                            </button>
                        </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h1 class="text-center">No Post YET</h1>
            @endif
        </div>
    </div>
@endsection
