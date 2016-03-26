@extends('layouts/master')

@section('content')
  <div class="page-header">
    <h1>{{ isset($fruit) ? 'Edit' : 'New' }} Fruit</h1>
  </div>

  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal" method="POST" action="/fruit{{ isset($fruit) ? '/'.$fruit->id : '' }}">
        {{ csrf_field() }}

        @if (isset($fruit))
          {{ method_field('PUT') }}
        @endif

        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="Banana" value="{{ $fruit->name or '' }}">
          </div>
        </div>
        <div class="form-group">
          <label for="description" class="col-sm-2 control-label">Description</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="description" id="description" placeholder="A yellow curved fruit." value="{{ $fruit->description or '' }}">
          </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">{{ isset($fruit) ? 'Save' : 'Add' }}</button>
      </form>
    </div>
  </div>
@stop