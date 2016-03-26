@extends('layouts/master')

@section('content')
  <div class="page-header">
    <h1>{{ isset($store) ? 'Edit' : 'New' }} Store</h1>
  </div>

  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal" method="POST" action="/store{{ isset($store) ? '/'.$store->id : '' }}">
        {{ csrf_field() }}

        @if (isset($store))
          {{ method_field('PUT') }}
        @endif

        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="Robinson's" value="{{ $store->name or '' }}">
          </div>
        </div>
        <div class="form-group">
          <label for="address" class="col-sm-2 control-label">Address</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="address" id="address" placeholder="123 Street/Bldg, City" value="{{ $store->address or '' }}">
          </div>
        </div>
        <div class="form-group">
          <label for="contact" class="col-sm-2 control-label">Contact Detail</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="contact" id="contact" placeholder="09156789123" value="{{ $store->contact or '' }}">
          </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">{{ isset($store) ? 'Save' : 'Add' }}</button>
      </form>
    </div>
  </div>
@stop