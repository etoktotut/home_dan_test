@extends('layouts.app')
@section('title-block')Сообщениe @endsection
@section('content')
  <h1>сообщение</h1>
  <div class="alert alert-info">
  <h3>{{$data->subject}}</h3>
  <p><small>{{$data->created_at}}</small>   {{$data->email}}</p>
    <p>{{$data->name}}</p>
      <p>{{$data->message}}</p>
    <a class='btn btn-warning' href="{{route('one-message-edit',$data->id)}}">Редактировать</a>
      <a class='btn btn-danger' href="{{route('one-message-delete',$data->id)}}">Удалить</a>
              </div>
  @endsection
