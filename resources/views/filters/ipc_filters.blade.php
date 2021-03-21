<div class="col-6"><h3>Фильтр</h3></div>

<div class="alert alert-info shadow" style="padding-right:40px;">
    <div class="row">
        <div class="col-12">
            <p align="right">Найдено {{ $cam_count }} кам.</p>
        </div>
    </div>

    <form action="{{ route('ipc.filters') }}">
        <!--  -->
        <!-- // ipc/filtered -->
        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label for="vendor">Вендор</label>
                    <p>
                        <select name="vendor">
                            <option value="0">Любой</option>
                            @foreach ($vendors as $ven)
                            <option value="{{$ven->id}}" {{request()->vendor == $ven->id ? 'selected' : '' }}>
                                {{$ven->vendor_name}}
                            </option>
                            @endforeach
                        </select>
                    </p>
                </div>

                <div class="col-4">
                    <label for="mp"><small> Разрешение</small></label>
                            <select name="mp">
                            <option value="0" {{ request()->mp == 0 ? 'selected' : '' }}>Любое</option>
                            <option value="2" {{ request()->mp == 2 ? 'selected' : '' }}>2 Мп</option>
                            <option value="3" {{ request()->mp == 3 ? 'selected' : '' }}>3 Мп</option>
                            <option value="4" {{ request()->mp == 4 ? 'selected' : '' }}>4 Мп</option>
                            <option value="5" {{ request()->mp == 5 ? 'selected' : '' }}>5 Мп</option>
                            <option value="6" {{ request()->mp == 6 ? 'selected' : '' }}>6 Мп</option>
                            <option value="8" {{ request()->mp == 8 ? 'selected' : '' }}>8 Мп</option>
                            <option value="12" {{ request()->mp == 12 ? 'selected' : '' }}>12 Мп</option>
                        </select>
                    </div>
                <div class="col-4">
                    <label for="ipc_type">Корпус</label>
                    <p>
                        <select name="ipc_type">
                            <option value="0">Любой</option>
                            @foreach ($ipctypes as $type)
                            <option value="{{$type->id}}" {{ request()->ipc_type == $type->id ? 'selected' : '' }}>{{$type->type_name}}</option>
                            @endforeach
                        </select>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    <small> Антивандальная</small>
                    <input type="checkbox" id="vand" name="vand" {{request()->has('vand') ? 'checked' : '' }}>
                </div>
            </div>
        </div>

        <label for="lens_type">Объектив</label>
        <p>
            <select name="lens_type">
                <option value="0">Любой</option>
                @foreach ($lenstypes as $ltype)
                <option value="{{$ltype->id}}" {{request()->lens_type == $ltype->id ? 'selected' : '' }}>{{$ltype->lenstype_name}}</option>
                @endforeach
            </select>
        </p>
        <div class="form-group">
            <!-- Угол обзора -->
            <input
                type="checkbox"
                id="ang_chk"
                name="ang_chk"
                {{request()->has('ang_chk') ? 'checked' : '' }}> <small>Угол обзора</small>
            <div style="position:relative; margin:auto; width:95%">
                <span style="position:absolute; color:grey; border:1px solid blue; min-width:100px;margin-left:10px;">
                    <span id="AnglValue"></span>
                </span>
                <input type="range" id="AnglRange" name="angle_range" max="130" min="50" step="1" value="{{request()->has('ang_chk') ? request()->angle_range : '85'}}" style="width:90%;">
              </div>
        </div>
        <!-- ИК- подсветка -->
        <div class="form-group">
            <input type="checkbox" id="ir_chk" name="ir_chk" value="0" {{request()->has('ir_chk') ? 'checked' : '' }} > <small>Дальность подсветки</small>
            <div style="position:relative; margin:auto; width:90%">
                <span style="position:absolute; color:grey; border:1px solid blue; min-width:100px;margin-left:10px;">
                    <span id="IrValue"></span>
                </span>
                <input type="range" id="IrRange" name="ir_range" max="500" min="10" step="10" value="{{request()->has('ir_chk') ? request()->ir_range : '30'}}" style="width:90%;">
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <input
                        type="checkbox"
                        id="mic"
                        name="mic"
                        {{request()->has('mic') ? 'checked' : '' }}> <small>Микрофон</small><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="checkbox" id="au_in" name="au_in" {{request()->has('au_in') ? 'checked' : '' }}> <small>Аудио-вход </small>
                    <input type="checkbox" id="au_out" name="au_out" {{request()->has('au_out') ? 'checked' : '' }}> <small>Аудио-выход</small><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="checkbox" id="al_in" name="al_in" {{request()->has('al_in') ? 'checked' : '' }}>
                    <small>Трев.вх. </small>
                    <input type="checkbox" id="al_out" name="al_out" {{request()->has('al_out') ? 'checked' : '' }}> <small>Трев.вых.</small><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="checkbox" id="msd" name="msd" {{request()->has('msd') ? 'checked' : '' }}> <small>MicroSD</small>
                    <input type="checkbox" id="wifi" name="wifi" {{request()->has('wifi') ? 'checked' : '' }}> <small>WiFi</small><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="is_eol"
                        ><small>Снятые с производства (EOL)</small></label>
                    <p>
                        <select name="is_eol">
                            <option value="0" {{ (request()->has('is_eol')) and (request()->is_eol == 0) ? 'selected': '' }}>Исключая EOL</option>                      >
                            <option value="2" {{ (!(request()->has('is_eol')) or (request()->is_eol == 2)) ? 'selected': '' }}>Включая EOL</option>                            >
                            <option value="1" {{ request()->is_eol == 1 ? 'selected' : '' }}>Только EOL</option>
                        </select>
                    </p>
                </div>
                <div class="col-6">
                    <label for="is_project"><small>Проектные</small></label>
                    <p>
                        <select name="is_project">
                            <option value="0" @if (request()->has('is_project') and (request()->is_project == 0)) selected @endif >Исключая их</option>                            >
                            <option value="2" @if (!(request()->has('is_project')) or (request()->is_project == 2)) selected @endif>Включая их</option>                            >
                            <option value="1" @if (request()->is_project == 1 )@endif>Только их</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-1">
            <div class="col-12">
                <h6>Наличие:</h6>
            </div>
            <div class="col-12">
                <input type="checkbox" class="main__stock__chk" id="isOnstock" name="isOnstock" {{request()->has('isOnstock') ? 'checked' : '' }}>
                <small>Склад (глобально)</small>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <input type="checkbox" class="sub__stock__chk" id="isOnMskStock" name="isOnMskStock" {{request()->has('isOnMskStock') ? 'checked' : '' }}>
                <small>Склад Москва</small>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <input type="checkbox" class="sub__stock__chk" id="isOnSpbStock" name="isOnSpbStock" {{request()->has('isOnSpbStock') ? 'checked' : '' }}>
                <small>Склад Питер</small>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 ">
                <input type="checkbox" class="sub__stock__chk" id="isOnRstStock" name="isOnRstStock" {{request()->has('isOnRstStock') ? 'checked' : '' }}>
                <small>Склад Ростов</small>
            </div>
        </div>

        <div class="row ">
            <div class="col-6">
                <input type="hidden" id="cam_pp1" name="cam_pp1" value="{{ $cam_pp }}">
                <button type="submit" class="btn btn-primary shadow" id="btn_filter">Фильтровать</button>
            </div>
            <div class="col-6">
                <a class="btn btn-warning shadow" href="{{ route('ipc.all') }}">Сбросить фильтры</a>
            </div>
        </div>
    </form>
</div>

<!-- функция смены количества камер при просмотре -->
