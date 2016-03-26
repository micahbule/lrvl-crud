@extends('layouts/master')

@section('content')
	<div class="page-header">
    <h1>{{ $fruit->name }}</h1>
  </div>

  <h3>P {{ $fruit->price }}</h3>
  <p>{{ $fruit->description }}</p>
@stop