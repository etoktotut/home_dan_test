<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="{{ route('home') }}">Домашняя</a>
    <a class="p-2 text-dark" href="{{route('contact')}}">Контакты</a>
    <a class="p-2 text-dark" href="{{route('all_messages')}}">Сообщения</a>
    <a class="p-2 text-dark" href="{{route('ipc.all')}}">IP-камеры</a>
    @if (Auth::check())
    <a class="p-2 text-dark" href="{{route('ipc.form')}}">Cam add</a>
    <a class="p-2 text-dark" href="{{route('stock.fill')}}">Склад</a>
    @else

    @endif
    <a class="p-2 text-dark" href="{{route('about')}}">О нас</a>
  </nav>
  @if (Auth::check())
  <a class="btn btn-outline-primary" href="{{route('logout')}}">Logout</a>
  @else
  <a class="btn btn-outline-primary" href="{{route('login')}}">Login</a>
  @endif
</div>
