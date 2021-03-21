@extends('layouts.app')
@section('title-block')Камеры@endsection
@section('scripts')
  <script type="text/javascript" src="http://127.0.0.1:8000/storage/js/ipc_all.js" defer></script>
@endsection

@section('content')
  <div class="row">
      <div class="col-6">
        <h3>Все камеры</h3>
      </div>
      <div class="col-6">
        {{ $cameras->appends(compact('cam_pp'))->onEachSide(0)->links() }}
      </div>
  </div>


  @foreach($cameras as $cam)

              <div class="alert alert-warning shadow">
<div class="row">
  <div class="col-3">
    <div class="row">
        <img src="{{Storage::url($cam->small_image)}}" alt="" align="center" width="160" height="120">
    </div>
    <div class="row" style="margin-left:10px;">
      @if ($cam->is_project)
          <span style="color:red;font-weight: bold;">(PROJECT)</span>
      @endif
        Цена: {{ isset($cam->price) ? "{$cam->price->rrc_price} руб." : "Нет в прайсе" }}
    </div>
    <div class="row">
        <a class="btn btn-warning" href="{{route('ipc.one',$cam->id)}}" target="_blank" style="margin-left:20px; margin-top:10px;">Подробно</a>
    </div>
    </div>
  <div class=" col-5">
    <div class="row">
      <h3>
        <small>{{$cam->vendor->vendor_name}}
          {{$cam->resolution_MP}}Мп
          <small>{{$cam->ipctype->type_name}} ({{$cam->id}})</small></small>
      </h3>
    </div>
    <div class="row">
      <b>{{$cam->pn}}</b>
      @if ($cam->is_eol)
          <span style="color:blue;font-weight: bold;">(EOL)</span>
      @endif

    </div>

    <div class="row">
      <div class="col-6">
        <div class="tech">
        <b>Разрешение:</b><br>
        {{$cam->resolution}}<br>
          {{$cam->sens_size}}"
          <p>
          <small><b>Подсветка:</b> {{ isset($cam->lighttype) ? "{$cam->lighttype->lighttype_name}" : "Нет" }}<br>
          <b>Дальность:</b> {{$cam->light_distance}} м</small></p>

        </div>

      </div>
        <div class="col-6">
          <div class="tech">
            <b>Объектив:</b>
            <p>{{$cam->lenstype->lenstype_name}}<br>
              f = {{$cam->near_fl}} @if ($cam->far_fl > 0) - {{$cam->far_fl}} @endif мм <br>
              <small>Угол: {{$cam->h_angle_wide}}&deg @if ($cam->h_angle_tele > 0) - {{$cam->h_angle_tele}}&deg @endif</small><br>
              @if ($cam->far_fl > 0)<small>Zoom: {{$cam->zoomx}}</small>@endif
            </p>
            <small>
            @if ($cam->micro_sd > 0) <b>MicroSD:</b>{{$cam->micro_sd}} Gb @endif <br>
            @if ($cam->wifi > 0) <b>Wifi</b>: Есть! @endif<br>
            </small>
          </div>
        </div>
        </div>
    </div>
    <div class="col-4">
      <div class="tech">
        <div class="codecs">
          <small><b>Кодеки:</b><br>
          {{$cam->codecs}}</small><br>
        </div>
        <small><b>Потоков:</b> {{$cam->streams}}</small><br>
        <b>Защита:</b>  @if ($cam->protection_class) {{$cam->protection_class}} @else <small>Нет</small> @endif<br>
        <b>Темп.работы:</b> {{$cam->low_temp}}&deg +{{$cam->high_temp}}&deg<br>
        <b>Питание:</b> {{$cam->power_type}}<br>
        <b>Потребление:</b> {{$cam->power_consumption}}Вт<br>
        <b>Микрофон:</b> @if ($cam->mic > 0) <b> Есть</b> @else <small> Нет</small> @endif <br>
        <b>Аудио-вход:</b> @if ($cam->audio_in > 0) <b> Есть</b> @else <small> Нет</small> @endif <br>
        <b>Аудио-выход</b> @if ($cam->audio_out > 0) <b> Есть</b> @else <small> Нет</small> @endif <br>
        <b>Трев. вход:</b> @if ($cam->alarm_in > 0) <b> {{$cam->alarm_in}}</b> @else <small> Нет</small> @endif <br>
        <b>Трев. выход:</b> @if ($cam->alarm_out > 0) <b> {{$cam->alarm_out}}</b> @else <small> Нет</small> @endif <br>
      </div>

    </div>
  </div>

  <div class="row">
      <div class="col-3 ">


      </div>
  </div>
      <div class="col-4">

      </div>
      <div class="col-4">

      </div>

<div class="row" style="margin-top:1rem;">
  <div class="col-6" style="padding-right:10px;">
    <div class="row">
      <div class="col-2 stock1">Total</div>
      <div class="col-1 stock1">MSK</div>
      <div class="col-1 stock1">SPB</div>
      <div class="col-1 stock1">RST</div>
      <div class="col-1 stock1">KRR</div>
      <div class="col-1 stock1">EKB</div>
      <div class="col-1 stock1">PRM</div>
      <div class="col-1 stock1">CEK</div>
      <div class="col-1 stock1">TJM</div>
      <div class="col-1 stock1">NSK</div>
      <div class="col-1 stock1">OMS</div>
    </div>
    <!-- первая половина - наличие -->
    <div class="row">
      <div class="col-2 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tot_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tot_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tot_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tot_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->msk_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->msk_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->msk_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->msk_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->spb_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->spb_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->spb_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->spb_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->rst_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->rst_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->rst_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->rst_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->krr_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->krr_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->krr_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->krr_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->ekb_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->ekb_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->ekb_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->ekb_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->prm_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->prm_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->prm_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->prm_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->cek_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->cek_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->cek_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->cek_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tjm_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tjm_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tjm_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tjm_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->nsk_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->nsk_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->nsk_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->nsk_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->oms_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->oms_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->oms_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->oms_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
    </div>
    <!-- первая половина - свободные -->
    <div class="row">
      <div class="col-2 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tot_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tot_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tot_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tot_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->msk_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->msk_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->msk_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->msk_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->spb_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->spb_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->spb_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->spb_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->rst_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->rst_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->rst_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->rst_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->krr_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->krr_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->krr_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->krr_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->ekb_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->ekb_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->ekb_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->ekb_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->prm_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->prm_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->prm_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->prm_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->cek_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->cek_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->cek_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->cek_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tjm_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tjm_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tjm_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->tjm_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->nsk_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->nsk_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->nsk_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->nsk_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
      <div class="col-1 stock1">
        @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
          @elseif (intval($cam->stock->oms_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
          @elseif (intval($cam->stock->oms_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
          @elseif (intval($cam->stock->oms_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
          @elseif (intval($cam->stock->oms_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
          @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
        @endif
      </div>
    </div>
  </div>
  <div class="col-6" >
    <div class="row">
                <div class="col-1 stock1">KJA</div>
     <div class="col-1 stock1">VVO</div>
     <div class="col-1 stock1">IKT</div>
         <div class="col-1 stock1"></div>
    </div>

  <div class="row">
    <div class="col-1 stock1">
      @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
        @elseif (intval($cam->stock->kja_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
        @elseif (intval($cam->stock->kja_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
        @elseif (intval($cam->stock->kja_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
        @elseif (intval($cam->stock->kja_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
        @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
      @endif
    </div>
    <div class="col-1 stock1">
      @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
        @elseif (intval($cam->stock->vvo_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
        @elseif (intval($cam->stock->vvo_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
        @elseif (intval($cam->stock->vvo_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
        @elseif (intval($cam->stock->vvo_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
        @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
      @endif
    </div>
    <div class="col-1 stock1">
      @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
        @elseif (intval($cam->stock->ikt_t) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
        @elseif (intval($cam->stock->ikt_t) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
        @elseif (intval($cam->stock->ikt_t) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
        @elseif (intval($cam->stock->ikt_t) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
        @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
      @endif
    </div>
    <div class="col-1 stock1">
<br>
      всего
    </div>

   </div>
   <div class="row">
     <div class="col-1 stock1">
       @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
         @elseif (intval($cam->stock->kja_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
         @elseif (intval($cam->stock->kja_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
         @elseif (intval($cam->stock->kja_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
         @elseif (intval($cam->stock->kja_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
         @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
       @endif
     </div>
     <div class="col-1 stock1">
       @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
         @elseif (intval($cam->stock->vvo_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
         @elseif (intval($cam->stock->vvo_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
         @elseif (intval($cam->stock->vvo_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
         @elseif (intval($cam->stock->vvo_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
         @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
       @endif
     </div>
     <div class="col-1 stock1">
       @if (isset($cam->stock)==false) <img src="/storage/icons/question.svg"  width="20" height="20">
         @elseif (intval($cam->stock->ikt_f) == 0 ) <img src="/storage/icons/reception-0.svg"  width="20" height="20">
         @elseif (intval($cam->stock->ikt_f) < 10 ) <img src="/storage/icons/reception-1.svg"  width="20" height="20">
         @elseif (intval($cam->stock->ikt_f) < 20 ) <img src="/storage/icons/reception-2.svg"  width="20" height="20">
         @elseif (intval($cam->stock->ikt_f) < 100 ) <img src="/storage/icons/reception-3.svg"  width="20" height="20">
         @else <img src="/storage/icons/reception-4.svg"  width="20" height="20">
       @endif
     </div>
     <div class="col-1 stock1">
       <br>
       свободных
     </div>

   </div>
  </div>
</div>






    </div>
  @endforeach
{{ $cameras->appends(compact('cam_pp'))->onEachSide(1)->links() }}
  @endsection


  @section('aside')
<form class="alert alert-light shadow" action="" method="get">
  <label>Камер на станице: </label>
   <select id="cam_pp" name="cam_pp">
       <option value="5" @if($cam_pp == 5) selected @endif >5</option>
       <option value="10" @if($cam_pp == 10) selected @endif>10</option>
       <option value="15" @if($cam_pp == 15) selected @endif>15</option>
       <option value="20" @if($cam_pp == 20) selected @endif>20</option>
   </select>
</form>
@include('filters.ipc_filters')
@include('seek.ipc_seek')

<!-- <script>
$('#cam_pp').on('change',function() {
  // window.location = window.location+"&cam_pp=" + this.value;
      var $s=window.location.href;
      $b=$s.split("?");
      if ($b[1]) {
       var queries = {};
         $.each(window.location.search.substr(1).split('&'), function(c,q){
             var i = q.split('=');
             queries[i[0].toString()] = unescape(i[1].toString()); // change escaped characters in actual format
             });
             queries['cam_pp']=this.value;
             window.location.href=$b[0]+"?"+$.param(queries); // it reload page
               }
               else {
                 window.location.href=$b[0]+"?"+"cam_pp="+this.value; // it reload page
               }
  });
  </script> -->

  @endsection
