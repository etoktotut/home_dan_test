<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IpcRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    //  dd($this);
      // если выбран тип объектива "фикс", то второе фокусное и теле-угол обзора можно не проверять.
      $ff=$ang_t=$ird='';
      if ($this->lenstype_id > 1) {$ff=$ang_t='required';}
      if ($this->lighttype_id > 1 ) {$ird='required';}



        return [
          'pn'=>'required',
          //|unique:ipcs
          //'ipc_image'=>'',
          'resolution'=>'required',
          'sens_size'=>'required',
          'near_fl'=>'required',
          'far_fl'=>$ff,
          'h_angle_wide'=>'required',
          'h_angle_tele'=>$ang_t,
          'light_distance'=>$ird,
          'streams'=>'required',
          'codecs'=>'required',
          'power_type'=>'required',
          'power_consumption'=>'required',
          'low_temp'=>'required',
          'high_temp'=>'required',
          'fromprice_description'=>'required',

                            ];
    }
}
