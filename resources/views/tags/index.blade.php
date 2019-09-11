@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
        <a href="{{ route('tags.create')}}" class="btn btn-outline-success btn-rounded waves-effect"><i class="fas fa-cogs pr-2" aria-hidden="true"></i>Add Tags</a>
</div>

<div class="card card-default">
  <div class="card-header">Tags</div>
  <div class="card-body">
    @if($tags->count() > 0)
    <table class="table">
      <thead>
        <th>Name</th>
        <th>Posts Count</th>
        <th></th>
      </thead>

      <tbody>
        @foreach($tags as $tag)
          <tr>
            <td>
              {{ $tag->name }}
            </td>
            <td>
              {{ $tag->posts->count() }}
            </td>
            <td>
                <a href="{{route('tags.edit', $tag->id) }}" class="btn btn-outline-info waves-effect btn-sm"><i class="fas fa-edit"></i> Edit</a>
                <button class="btn btn-outline-danger waves-effect btn-sm" onclick="handleDelete({{ $tag->id }})"><i class="fas fa-trash"></i> Delete</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
            <form action="" method="POST" id="deleteTagsForm">
                    @csrf
                    @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-bold"></p>Anda yakin menghapusnya???
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary waves-effect btn-md" data-dismiss="modal">No, Go back</button>
                        <button type="submit" class="btn btn-outline-danger waves-effect btn-md"> Delete</button>
                    </div>
                </div>
            </form>
      </div>
    </div>
    @else
    <h3 class="text-center">No tags yet.</h3>
    @endif
  </div>
</div>
@endsection

@section('script')
  <script>
    function handleDelete(id) {
      var form = document.getElementById('deleteTagsForm')
      form.action = '/tags/' + id
      $('#deleteModal').modal('show')
    }
  </script>
@endsection
