@extends('layouts/master')

@inject('request', 'Illuminate\Http\Request')

@section('content')
  <div class="page-header">
    <h1>Fruits</h1>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">Available Fruits</div>
    <div class="panel-body">
      <a href="/fruit/create" class="btn btn-success">Add Fruit</a>
      <a href="/fruit/deleted" class="btn pull-right">Show Deleted Fruits</a>
    </div>

    <table class="table table-hover table-condensed">
      <thead>
        <tr>
          <td>Name</td>
          <td>Price</td>
          <td class="col-md-3">Actions</td>
        </tr>
      </thead>
      <tbody>
        @foreach($fruits as $fruit)
          <tr>
            <td>{{ $fruit->name }}</td>
            <td>P {{ $fruit->price }}</td>
            <td>
              <div class="btn-group" role="group">
                <a href="/fruit/{{ $fruit->id }}/edit" class="btn btn-default">Edit</a>
                <button type="button" class="btn {{ $request->is('fruit/deleted') ? 'btn-primary' : 'btn-danger' }}" data-toggle="modal" data-target=".bs-example-modal-sm" data-fruit-id="{{ $fruit->id }}" data-message="Are you sure you want to {{ ($request->is('fruit/deleted') ? 'restore ' : 'delete ').$fruit->name }}?">{{ $request->is('fruit/deleted') ? 'Restore' : 'Delete' }}</button>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <form method="POST" id="fruitModalForm">
          {{ csrf_field() }}

          @if ($request->is('fruit/deleted'))
            {{ method_field('PUT') }}
            <input type="hidden" name="restore" value="1">
          @else
            {{ method_field('DELETE') }}
          @endif

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">{{ $request->is('fruit/deleted') ? 'Restore' : 'Delete' }} Fruit?</h4>
          </div>
          <div class="modal-body">
            <span id="fruitModalLabel"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn {{ $request->is('fruit/deleted') ? 'btn-primary' : 'btn-danger'}}">{{ $request->is('fruit/deleted') ? 'Restore' : 'Delete' }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{ $fruits->links() }}
@stop

@section('scripts')
  <script>
    $('.bs-example-modal-sm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('fruit-id');
      var message = button.data('message');

      $('#fruitModalLabel').text(message);
      $('#fruitModalForm').attr('action', '/fruit/' + id);
    });
  </script>
@stop