@extends('layouts.app')
@section('title-block')Страница контактов@endsection
@section('content')
  <h1>Контакты</h1>
  <form action="{{route('contact-form')}}" method="post">
    @csrf
    <div class="form-group">
      <label for="name">Введите имя:</label>
      <input type="text" name="name" placeholder="Введите имя" id="name" class="form-control">
    </div>
    <div class="form-group">
      <label for="e-mail">E-mail:</label>
      <input type="text" name="e-mail" placeholder="Введите E-mail" id="e-mail" class="form-control">
    </div>
    <div class="form-group">
      <label for="subject">Тема сообщения:</label>
      <input type="text" name="subject" placeholder="Введите тему сообщения" id="subject" class="form-control">
    </div>
    <div class="form-group">
      <label for="message">Текст сообщения:</label>
      <textarea name="message" placeholder="Введите текст сообщения" id="message" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>
  </form>

<form action="" method="get">
  <div class="form-group">
    <label for="ipc_image">Изображение:</label>
    <input type="file" name="ipc_image" placeholder="Укажите изображение" id="ipc_image" class="form-control">
  </div>
<button type="submit" class="btn btn-success">Тестануть</button>
</form>


  @endsection
