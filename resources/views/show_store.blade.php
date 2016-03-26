@extends('layouts/master')

@section('content')
	<div class="page-header">
    <h1>{{ $store->name }}</h1>
  </div>

  <h3>{{ $store->address }}</h3>
  <p>{{ $store->contact }}</p>
@stop