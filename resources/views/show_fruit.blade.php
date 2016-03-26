@extends('layouts/master')

@section('content')
	<div class="page-header">
    <h1>{{ $fruit->name }}</h1>
  </div>

  <p>{{ $fruit->description }}</p>
@stop