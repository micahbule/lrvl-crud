@extends('layouts/master')

@inject('request', 'Illuminate\Http\Request')

@section('content')
  <div class="page-header">
    <h1>Stores</h1>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">Available Stores</div>
    <div class="panel-body">
      <a href="/store/create" class="btn btn-success">Add Store</a>
      <a href="/store/deleted" class="btn pull-right">Show Deleted Stores</a>
    </div>

    <table class="table table-hover table-condensed">
      <thead>
        <tr>
          <td>Name</td>
          <td>Address</td>
          <td>Contact Detail</td>
          <td class="col-md-3">Actions</td>
        </tr>
      </thead>
      <tbody>
        @foreach($stores as $store)
          <tr>
            <td><a href="/store/{{ $store->id }}">{{ $store->name }}</a></td>
            <td>{{ $store->address }}</td>
            <td>{{ $store->contact }}</td>
            <td>
              <div class="btn-group" role="group">
                <a href="/store/{{ $store->id }}/edit" class="btn btn-default">Edit</a>
                <button type="button" class="btn {{ $request->is('store/deleted') ? 'btn-primary' : 'btn-danger' }}" data-toggle="modal" data-target=".bs-example-modal-sm" data-store-id="{{ $store->id }}" data-message="Are you sure you want to {{ ($request->is('store/deleted') ? 'restore ' : 'delete ').$store->name }}?">{{ $request->is('store/deleted') ? 'Restore' : 'Delete' }}</button>
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
        <form method="POST" id="storeModalForm">
          {{ csrf_field() }}

          @if ($request->is('store/deleted'))
            {{ method_field('PUT') }}
            <input type="hidden" name="restore" value="1">
          @else
            {{ method_field('DELETE') }}
          @endif

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">{{ $request->is('store/deleted') ? 'Restore' : 'Delete' }} Store?</h4>
          </div>
          <div class="modal-body">
            <span id="storeModalLabel"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn {{ $request->is('store/deleted') ? 'btn-primary' : 'btn-danger'}}">{{ $request->is('store/deleted') ? 'Restore' : 'Delete' }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{ $stores->links() }}
@stop

@section('scripts')
  <script>
    $('.bs-example-modal-sm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('store-id');
      var message = button.data('message');

      $('#storeModalLabel').text(message);
      $('#storeModalForm').attr('action', '/store/' + id);
    });
  </script>
@stop