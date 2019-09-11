@extends('layouts.app')

@section('content')
<div class="card card-default">
  <div class="card-header">Users</div>

  <div class="card-body">
    @if($users->count() > 0)
      <table class="table">
        <thead>
          <th>Image</th>
          <th>Name</th>
          <th>Email</th>
          <th></th>
          <th></th>
        </thead>
        <tbody>
          @foreach($users as $p)
            <tr>
              <td>
                    <img width="40px" height="40px" style="border-radius: 50%; border: 1px solid #fff" src="{{ Gravatar::src($p->email) }}" alt="">
              </td>
              <td>
                {{ $p->name }}
              </td>
              <td>
                {{ $p->email }}
              </td>
              <td>
                    @if (!$p->isAdmin())
                <form action="{{ route('users.make-admin', $p->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-success waves-effect btn-sm">Make Admin</button>
                </form>
                    @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <h3 class="text-center">No Users Yet</h3>
    @endif
  </div>
</div>
@endsection
