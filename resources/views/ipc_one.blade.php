@extends('layouts.app')
@section('title-block')Камера {{$cam->id}}@endsection
@section('content')
  <h3>Камера {{$cam->id}}</h3>
    <div class="alert alert-warning shadow">
<div class="row">
  <div class="col-3">
    <div class="row">
        <img src="{{Storage::url($cam->small_image)}}" alt="" align="center" width="160" height="120">
    </div>
    <div class="row" style="margin-left:10px;">
        Цена: {{ isset($cam->price) ? "{$cam->price->rrc_price} руб." : "Нет в прайсе" }}
    </div>
    @if(Auth::check())
    <div class="row">
        <a class="btn btn-warning" href="{{route('ipc.edit',$cam->id)}}" style="margin-left:20px; margin-top:10px;">Редактировать</a>
    </div>
    <div class="row">
        <a class="btn btn-info" href="{{route('ipc.one.copy',$cam->id)}}" style="margin-left:20px; margin-top:10px;">Копировать</a>
    </div>
    @endif
    </div>
  <div class=" col-5">
    <div class="row">
      <h4>
        {{$cam->vendor->vendor_name}}
        {{$cam->resolution_MP}}Мп
        <small>{{$cam->ipctype->type_name}}</small>
      </h4>
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
          <small><b>Подсветка:</b>  {{ isset($cam->lighttype) ? "{$cam->lighttype->lighttype_name}" : "Нет" }} <br>
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

        <b>Защита:</b> @if ($cam->protection_class) {{$cam->protection_class}} @else <small>Нет</small> @endif <br>
        <b>Темп.работы:</b> {{$cam->low_temp}}&deg +{{$cam->high_temp}}&deg<br>
        <b>Питание:</b> {{$cam->power_type}}<br>
        <b>Потребление:</b> {{$cam->power_consumption}}Вт<br>
        <b>Микрофон:</b> @if ($cam->mic > 0) <b>Есть</b> @else <small>Нет</small> @endif <br>
        <b>Аудио-вход:</b> @if ($cam->audio_in > 0) <b> Есть</b> @else <small> Нет</small> @endif <br>
        <b>Аудио-выход</b> @if ($cam->audio_out > 0) <b> Есть</b> @else <small> Нет</small> @endif <br>
        <b>Трев. вход:</b> @if ($cam->alarm_in > 0) <b> {{$cam->alarm_in}}</b> @else <small> Нет</small> @endif <br>
        <b>Трев. выход:</b> @if ($cam->alarm_out > 0) <b> {{$cam->alarm_out}}</b> @else <small> Нет</small> @endif

      </div>

    </div>
  </div>

  <div class="row">
      <div class="col-8 ">
        <br>
        <b>Кодеки:  </b>{{$cam->codecs}}
      </div>
      <div class="col-4">
        <br>
        <b>Потоков:</b> {{$cam->streams}}
      </div>
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
<div class="form-group row mt-10">
  <div class="col-sm-12" style="margin-top:2rem;">
    {{$cam->fromprice_description}}
    </div>
</div>






    </div>


  @endsection


  @section('aside')


  @endsection
