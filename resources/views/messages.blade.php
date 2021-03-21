@extends('layouts.app')
@section('title-block')Сообщения@endsection
@section('scripts')
  <script type="text/javascript" src="http://127.0.0.1:8000/storage/js/messages_accord.js" defer></script>
@endsection
@section('content')
  
<h4>Все сообщения</h4>

<div class="messages_list">
  @foreach($data as $el)
    <div class="message_item">
    <button class="btn {{$el->is_archive ? 'btn-warning' : 'btn-danger'}} narrow_look active">
        {{-- <div class="{{$el->is_archive ? 'alert-warning' : 'alert-danger'}} narrow_look_form "> --}}
          <span><small> {{$el->subject}} </span> {{$el->email}} {{$el->name}} </small>
      {{-- </div> --}}
    </button>
    
    <div class="wide_look">
        <div class="alert {{$el->is_archive ? 'alert-warning' : 'alert-danger'}} shadow bg-gradient-warning">
          <h2 class="wide_look_header">{{$el->subject}}</h2>
          <p><small>{{$el->created_at}}</small>   {{$el->email}}</p>
            <p>{{$el->name}}</p>
            <p><b>{{$el->is_archive ? 'Архивный' : 'Действующий'}}</b></p>
            <a class="btn btn-warning message_detailed" href="{{route('one-message',$el->id)}}">Подробнее</a>
    </div>
  </div>
  </div>
  @endforeach
  </div>

  @endsection


  @section('aside')
  @parent
  <div class="alert alert-info shadow"  >


  <h3>Фильтр</h3>
  <form action="/messages_1" >
    <div class="form-group">
      <label for="email" >Email</label>
      <input type="text"  class='form-control' name="email">
    </div>

    <div class="form-group">
      <label class="form-group">Архивный</label>
      <label for="is_archive" >Да</label>
        <input type="radio" name="is_archive" value='1'  id='is_archive'  >
      <label for="is_not_archive" >Нет</label>
        <input type="radio" name="is_archive" value='0'  id='is_not_archive' checked >
    </div>
    <button type="submit" class="btn btn-primary shadow">Фильтровать</button>

    </div>
  </form>
  </div>
  @endsection
