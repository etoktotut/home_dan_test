<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title-block')</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- <script type="text/javascript" src="jquery.js"></script> -->
  <link rel="stylesheet" href="/css/app.css">
  @yield('scripts')
</head>
<body>
  @include('inc.header')

  @if(Request::is('home'))
    @include('inc.hero')
  @endif
  <div class="container mt-5">
      @include('inc.alerts')
    <div class="row">
      <div class="col-8">
        @yield('content')
      </div>

    <div class="col-4">
      @include('inc.aside')
    </div>
        </div>
  </div>



@include('inc.footer')

</body>
</html>
