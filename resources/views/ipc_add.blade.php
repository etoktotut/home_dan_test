@extends('layouts.app')
@section('title-block')Добавление камеры@endsection
@section('content')
  <h1>Создание камеры:</h1>
    <div class="alert alert-warning shadow">

  <form action="{{route('ipc.add')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group row">
      <div class="col-sm-4">
        <div class="input-group input-group-sm mb-1">
          <div class="input-group-prepend">
            <span class="input-group-text" >Вендор:</span>
          </div>
          <select  name="vendor_id"  class="form-control">
        @foreach ($vendors as $ven)
          <option value="{{$ven->id}}"  {{request()->vendor == $ven->id ? 'selected' : '' }}>{{$ven->vendor_name}}</option>
        @endforeach
           </select>
        </div>
      </div>

        <div class="col-sm-4">
          <div class="input-group input-group-sm mb-1">
            <div class="input-group-prepend">
              <span class="input-group-text" >Корпус:</span>
            </div>
              <select  name="type_id" class="form-control">
              @foreach ($ipctypes as $type)
              <option value="{{$type->id}}" {{request()->ipc_type == $type->id ? 'selected' : '' }}>{{$type->type_name}}</option>
            @endforeach
            </select>
          </div>
        </div>
        <div class="col-sm-4">
          EOL <input type="checkbox" name="is_eol" >&nbsp&nbsp
          Aрх. <input type="checkbox" name="is_archive" >

        </div>


</div>

      <div class="form-group row">

          <div class="col-sm-6">
            <div class="input-group input-group-sm mb-1">
              <div class="input-group-prepend">
                <span class="input-group-text" >P/N:</span>
              </div>
                  <input type="text" name="pn" placeholder="Введите p/n" id="pn" class="form-control" >
            </div>
          </div>
        <div class="col-sm-4">
          <div class="input-group input-group-sm mb-1">
            <div class="input-group-prepend">
             <span class="input-group-text" >Мегапикселей:</span>
            </div>
            <select  name="resolution_MP" class="form-control">
              <option value=2 {{request()->mp == 2 ? 'selected' : '' }}>2 Мп</option>
              <option value=3 {{request()->mp == 3 ? 'selected' : '' }}>3 Мп</option>
              <option value=4 {{request()->mp == 4 ? 'selected' : '' }}>4 Мп</option>
              <option value=5 {{request()->mp == 5 ? 'selected' : '' }}>5 Мп</option>
              <option value=6 {{request()->mp == 6 ? 'selected' : '' }}>6 Мп</option>
              <option value=8 {{request()->mp == 8 ? 'selected' : '' }}>8 Мп</option>
              <option value=12 {{request()->mp == 12 ? 'selected' : '' }}>12 Мп</option>
              </select>
          </div>
        </div>
          <div class="col-sm-2">
            <small>WiFi </small><input type="checkbox" name="wifi" >
          </div>
  </div>



  <div class="form-group row">
    <div class="col-sm-7">
      <div class="input-group input-group-sm mb-1">
        <div class="input-group-prepend">
         <span class="input-group-text"  >jpg_small:</span>
        </div>
        <div class="custom-file form-control-sm" >
          <input type="file" class="custom-file-input " id="ipc_image" name="ipc_image"  >
          <label class="custom-file-label" for="ipc_image">Выберите файл</label>
        </div>
<!-- в input можно вставить: onchange="this.nextElementSibling.innerText = this.files[0].name" -->

      </div>
    </div>
    <div class="col-sm-5">
      <div class="input-group input-group-sm mb-1">
        <div class="input-group-prepend">
         <span class="input-group-text" >Resolution, px</span>
        </div>
        <input type="text" name="resolution" placeholder="типа 1920х1080" id="resolution" class="form-control">
      </div>
    </div>

</div>


    <div class="form-group row">
      <div class="col-sm-6">
        <div class="input-group input-group-sm mb-1">
          <div class="input-group-prepend">
           <span class="input-group-text" >Объектив:</span>
          </div>
          <select  name="lenstype_id"  class="form-control">
          @foreach ($lenstypes as $ltype)
          <option value="{{$ltype->id}}" {{request()->lens_type == $ltype->id ? 'selected' : '' }}>{{$ltype->lenstype_name}}</option>
          @endforeach
           </select>
         </div>
       </div>
       <div class="col-sm-6">
         <div class="input-group input-group-sm mb-1">
           <div class="input-group-prepend">
            <span class="input-group-text" >Sensor size:</span>
           </div>
           <input type="text" name="sens_size" placeholder="Размер в дюймах" id="sens_size" class="form-control">
         </div>
       </div>
     </div>




    <div class="form-group row">
      <div class="col-sm-4">
        <div class="input-group input-group-sm mb-1">
          <div class="input-group-prepend">
            <span class="input-group-text" >f min:</span>
          </div>
          <input type="number" step="0.01" class="form-control" name="near_fl" aria-describedby="inputGroup-sizing-sm">
          <div class="input-group-append">
            <span class="input-group-text" >мм</span>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group input-group-sm mb-1">
          <div class="input-group-prepend">
            <span class="input-group-text" >f max:</span>
          </div>
          <input type="number" step="0.01" class="form-control" name="far_fl" aria-describedby="inputGroup-sizing-sm">
          <div class="input-group-append">
            <span class="input-group-text" >мм</span>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-4">
        <div class="input-group input-group-sm mb-1">
          <div class="input-group-prepend">
            <span class="input-group-text" >Wide:</span>
          </div>
          <input type="number" step="0.01" class="form-control" name="h_angle_wide" aria-describedby="inputGroup-sizing-sm">
          <div class="input-group-append">
            <span class="input-group-text" >&deg</span>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="input-group input-group-sm mb-1">
          <div class="input-group-prepend">
            <span class="input-group-text" >Tele:</span>
          </div>
          <input type="number" step="0.01" class="form-control" name="h_angle_tele" aria-describedby="inputGroup-sizing-sm">
          <div class="input-group-append">
            <span class="input-group-text" >&deg</span>
          </div>
        </div>
      </div>

    </div>

    <div class="form-group row">

      <div class="col-sm-6">
        <div class="input-group input-group-sm mb-1">
          <div class="input-group-prepend">
            <span class="input-group-text" >Подсветка:</span>
          </div>
          <select  name="lighttype_id" class="form-control">
          <option value="0">Нет подсветки</option>
        @foreach ($lighttypes as $lit)
          <option value="{{$lit->id}}"  {{request()->lighttype == $lit->id ? 'selected' : '' }}>{{$lit->lighttype_name}}</option>
        @endforeach
           </select>

        </div>
      </div>
      <div class="col-sm-5">
        <div class="input-group input-group-sm mb-1">
          <div class="input-group-prepend">
            <span class="input-group-text" >Дальность:</span>
          </div>
          <input type="number" step="5" class="form-control" name="light_distance" aria-describedby="inputGroup-sizing-sm" min="0">
          <div class="input-group-append">
            <span class="input-group-text" >метров</span>
          </div>
        </div>
      </div>

      </div>

    <div class="form-group row">
        <div class="col-sm-3">
          <div class="input-group input-group-sm mb-1">
            <div class="input-group-prepend">
              <span class="input-group-text" >Потоков:</span>
            </div>
            <input type="number" step="1" class="form-control" name="streams" aria-describedby="inputGroup-sizing-sm">
          </div>
        </div>

        <div class="col-sm-9">
          <div class="input-group input-group-sm mb-1">
            <div class="input-group-prepend">
              <span class="input-group-text" >Кодеки:</span>
            </div>
            <input type="text" class="form-control" name="codecs" aria-describedby="inputGroup-sizing-sm">
          </div>
        </div>
      </div>


      <div class="form-group row">

            <div class="col-sm-5">
              <div class="input-group input-group-sm mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text" >Питание:</span>
                </div>
                <input type="text" class="form-control" name="power_type" aria-describedby="inputGroup-sizing-sm">
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group input-group-sm mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text" >P=</span>
                </div>
                <input type="number" step="0.01" class="form-control" name="power_consumption" aria-describedby="inputGroup-sizing-sm">
                <div class="input-group-append">
                  <span class="input-group-text" >Вт</span>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
            <div class="input-group input-group-sm mb-1">
              <div class="input-group-prepend">
                <span class="input-group-text" >SD card:</span>
              </div>
              <input type="number" step="1" class="form-control" name="micro_sd" value="256">
              <div class="input-group-append">
                <span class="input-group-text" >Gb</span>
              </div>
            </div>
            </div>
      </div>

<div class="form-group row">
 <div class="col-sm-2">
        <small>Микрофон:</small> <input type="checkbox"name="mic"/>
   </div>

  <div class="col-sm-4">
        <small>Аудио-вход:</small> <input type="checkbox" name="audio_in"/>&nbsp&nbsp
        <small>Аудио-выход:</small> <input type="checkbox" name="audio_out"/>

    </div>
    <div class="col-sm-3">
      <div class="input-group input-group-sm mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text" ><small>Трев. вх:</small></span>
        </div>
        <input type="number" step="1" class="form-control" name="alarm_in">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="input-group input-group-sm mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text" ><small>Трев.вых:</small></span>
        </div>
        <input type="number" step="1" class="form-control" name="alarm_out">
      </div>
    </div>

</div>

<div class="form-group row">

  <div class="col-sm-6">
    <div class="input-group input-group-sm mb-1">
      <div class="input-group-prepend">
        <span class="input-group-text" >Защита:</span>
      </div>
      <input type="text" class="form-control" name="protection_class">
    </div>
  </div>
  <div class="col-sm-3">
    <div class="input-group input-group-sm mb-1">
      <div class="input-group-prepend">
        <span class="input-group-text" >T min:</span>
      </div>
      <input type="number" step="1" class="form-control" name="low_temp">
      <div class="input-group-append">
        <span class="input-group-text" >&deg</span>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="input-group input-group-sm">
      <div class="input-group-prepend">
        <span class="input-group-text" >T max:</span>
      </div>
      <input type="number" step="1" class="form-control" name="high_temp" min="0" max="100">
      <div class="input-group-append">
        <span class="input-group-text" >&deg</span>
      </div>
    </div>
  </div>
  </div>
<div class="form-group row">

  <div class="col-sm-12">
    <div class="input-group input-group-sm">
      <div class="input-group-prepend">
        <span class="input-group-text">Описание</span>
      </div>
      <textarea class="form-control" name='fromprice_description'></textarea>
    </div>
  </div>

  </div>

  <div class="form-group row">
    <div class="col-sm-6">
      <div class="input-group input-group-sm mb-1">
        <div class="input-group-prepend">
      <span class="input-group-text">Цена:</span>
      </div>
        <input type="number" step="0.01" class="form-control" name="rrc_price">
        <div class="input-group-append">
      <span class="input-group-text">руб.</span>
      <span class="input-group-text">0.00</span>
        </div>
      </div>
    </div>
  </div>
<div class="row">

  <div class="col-2">
    <button type="submit" class="btn btn-success">Сохранить</button>
  </div>
</div>
    </form>
</div>

<script>

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#cam_image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
// проверка типа объектива, и если это фикс, то дисэйблим теле угол и теле фокусное
function check_fix(){
  if ($('#lenstype').val() == 1){
                           $('#far_fl').prop("disabled",true);
                           $('#h_angle_tele').prop("disabled",true);}
     else {$('#far_fl').prop("disabled",false);
     $('#h_angle_tele').prop("disabled",false);}

}
  $(function() {
    $(document).on('change', ':file', function() {var input = $(this), numFiles = input.get(0).files ? input.get(0).files.length : 1,
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');input.trigger('fileselect', [numFiles, label]);
    });
    $(document).ready( function() {
        $(':file').on('fileselect', function(event, numFiles, label) {var input = $(this).parents('.custom-file').find('.custom-file-label'),
        log = numFiles > 1 ? numFiles + ' files selected' : label;if( input.length ) {input.text(log);} else {if( log ) alert(log);}});
    });
  });

$('#lenstype').on('change', function() {check_fix();});

function mistral(){
                  $(this).prop('style','background-color:#48D1CC;');
                  }

$("input").change(mistral);
$("textarea").change(mistral);
$("select").change(mistral);

</script>
      @endsection
