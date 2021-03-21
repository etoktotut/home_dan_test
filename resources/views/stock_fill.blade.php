@extends('layouts.app')
@section('title-block')Набивка склада@endsection
@section('content')
  <h1>Набивка склада</h1>
  <form action="{{route('stock.pull')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="st_file">Выберите файл:</label>
      <input type="file" name="st_file" id="st_file" class="form-control" required>
    </div>

<button type="submit" class="button btn-success">Обработать</button>
</form>


  @endsection
