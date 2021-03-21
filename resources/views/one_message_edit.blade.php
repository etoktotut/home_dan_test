@extends('layouts.app')
@section('title-block')Сообщениe {{$data->id}} @endsection
@section('content')
  <h1>Редактирование cообщения {{$data->id}}</h1>
<div class="container-fluid">


  <form action="{{route('contact-update',$data->id)}}" method="post">
    @csrf
    <div class="form-group">
      <label for="name">Введите имя:</label>
      <input type="text" name="name" id="name" class="form-control" value="{{$data->name}}">
    </div>
    <div class="form-group">
      <label for="e-mail">E-mail:</label>
      <input type="text" name="e-mail" id="e-mail" class="form-control" value="{{$data->email}}">
    </div>
    <div class="form-group">
      <label for="subject">Тема сообщения:</label>
      <input type="text" name="subject" id="subject" class="form-control" value="{{$data->subject}}">
    </div>
    <div class="form-group">
      <label for="message">Текст сообщения:</label>
      <textarea name="message" id="message" class="form-control" >{{$data->message}}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Сохранить</button>
      </form>
      </div>
  @endsection
