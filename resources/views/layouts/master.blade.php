<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fruit Admin 1.0</title>
  <link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
  @include('../includes/nav')

  <div class="container-fluid">
  	@if ($message = session('success') !== null ? session('success') : session('error'))
  		<div class="alert alert-dismissible {{ 'alert-'.(session('success') !== null ? 'success' : 'danger') }}" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>{{ session('success') !== null ? 'Success' : 'Error'}}!</strong> {{ $message }}
			</div>
  	@endif

  	@yield('content')
  </div>

  <script src="/bower/jquery/dist/jquery.min.js"></script>
  <script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
  @yield('scripts')
</body>
</html>