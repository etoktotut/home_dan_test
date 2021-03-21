<?php





namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Dim\IpcFilters;
use App\Models\IPC;
use App\Http\Requests\IpcRequest;
use Illuminate\Support\Facades\Auth;


class IpcController extends Controller
{
// вывод всех камер списком
    public function all_cameras(Request $req, IpcFilters $filters)
    {
      $cam_pp= $req->cam_pp ?? ($req->cam_pp1 ?? 5) ;
      $req->merge(['is_eol' => '0',]);
      $cameras=\App\Models\IPC::with('stock','price')->filter($filters)->paginate($cam_pp)->withQueryString();
  //    $cameras=(new IpcFilters($cameras,$req))->apply()->paginate($cam_pp)->withQueryString();
      $cam_count=$cameras->total();
      return view('ipc_all',compact('cameras','cam_count','cam_pp'));
    }

// фильтрация камер по параметрам
    public function filters(Request $req,IpcFilters $filters)
    {
      $cam_pp= $req->cam_pp ?? ($req->cam_pp1 ?? 5);
      $cameras=\App\Models\IPC::with('stock','price')->filter($filters)->paginate($cam_pp)->withQueryString();
    //  $cameras=(new IpcFilters($cameras,$req))->apply()->paginate($cam_pp)->withQueryString();
      $cam_count=$cameras->total();
      return view('ipc_all',compact('cameras','cam_count','cam_pp'));
      }

// добавление камеры
  public function cam_add(IpcRequest $req)
  {
    //dd($req);
    $ipc=new IPC();
    $ipc->small_image= isset($req->ipc_image) ? Storage::disk('public')->putFileAs('images',$req->file('ipc_image'),$req->file('ipc_image')->getClientOriginalName()) : $req->ceip ;
    $ipc->pn=$req->pn;
    $ipc->vendor_id=$req->vendor_id;
    $ipc->type_id=$req->type_id;
    $ipc->sens_size=$req->sens_size;
    $ipc->resolution=$req->resolution;
    $ipc->resolution_MP=$req->resolution_MP;
    $ipc->lenstype_id=$req->lenstype_id;
    $ipc->near_fl=$req->near_fl;
    $ipc->h_angle_wide=$req->h_angle_wide;
//если фикс, то все параметры теледиапазона обнуляются
    if($req->lenstype_id == 1) {
                                $ipc->far_fl = null ;
                                 $ipc->h_angle_tele = null;
                                 $ipc->zoomx = null;
                                }
//если варик, то сохраняем параметры теледиапазона и вычисляем кратность зумирования объектива
    if ($req->lenstype_id > 1) {
                                $ipc->far_fl=$req->far_fl;
                                $ipc->zoomx= intval(round($req->far_fl/$req->near_fl));
                                $ipc->h_angle_tele=$req->h_angle_tele;
                               }

    $ipc->streams=$req->streams;
    $ipc->codecs=$req->codecs;

    $ipc->power_type=$req->power_type;
    $ipc->power_consumption=$req->power_consumption;
    $ipc->lighttype_id=$req->lighttype_id;
    $ipc->light_distance=$req->light_distance;
    if (isset($req->mic)) {$ipc->mic=true;}
    if (isset($req->audio_in)) {$ipc->audio_in=true;}
    if (isset($req->audio_out)) {$ipc->audio_out=true;}
    if (isset($req->alarm_in)) {$ipc->alarm_in=$req->alarm_in;}
    if (isset($req->alarm_out)) {$ipc->alarm_out=$req->alarm_out;}
    $ipc->high_temp=$req->high_temp;
    $ipc->low_temp=$req->low_temp;
    if (isset($req->protection_class)) {$ipc->protection_class=$req->protection_class;}
    if (isset($req->micro_sd)) {$ipc->micro_sd=$req->micro_sd;}
    if (isset($req->is_archive)) {$ipc->is_archive=true;}
    if (isset($req->is_eol)) {$ipc->is_eol=true;}
    if (isset($req->wifi)) {$ipc->wifi=true;}
    $ipc->fromprice_description=$req->fromprice_description;

    $ipc->save();

    $price = $ipc->price()->create(['rrc_price' => $req->rrc_price]);

    return redirect()->route('ipc.one',$ipc->id)->with('success','Камера была добавлена');
  }


public function cam_add_form()
{
  return view('ipc_add');
}

public function cam_one($id)
{
  $cam=\App\Models\IPC::with('stock','price')->find($id);
  return view('ipc_one',compact('cam'));
}

public function cam_edit($id)
{
  $cam=\App\Models\IPC::find($id);
  return view('ipc_one_edit',compact('cam'));
}

public function cam_copy($id)
{
  $cam_for_copy=\App\Models\IPC::find($id);
  $cam=$cam_for_copy->replicate();
  $cam->save();
  return view('ipc_one_edit',compact('cam'));
}

// сохранение отредактированной камеры
  public function cam_update($id,IpcRequest $req)
  {
    //dd($req);
    $ipc=IPC::find($id);
    if (isset($req->ipc_image)) $ipc->small_image=Storage::disk('public')->putFileAs('images',$req->file('ipc_image'),$req->file('ipc_image')->getClientOriginalName());
    $ipc->pn=$req->pn;
    $ipc->vendor_id=$req->vendor_id;
    $ipc->type_id=$req->type_id;

    $ipc->sens_size=$req->sens_size;
    $ipc->resolution=$req->resolution;
    $ipc->resolution_MP=$req->resolution_MP;

    $ipc->lenstype_id=$req->lenstype_id;
    $ipc->near_fl=$req->near_fl;
    $ipc->h_angle_wide=$req->h_angle_wide;
    //если фикс, то все параметры теледиапазона обнуляются
        if($req->lenstype_id == 1) {
                                    $ipc->far_fl = null ;
                                     $ipc->h_angle_tele = null;
                                     $ipc->zoomx = null;
                                    }
    //если варик, то сохраняем параметры теледиапазона и вычисляем кратность зумирования объектива

    if ($req->lenstype_id > 1) {
                                $ipc->far_fl=$req->far_fl;
                                $ipc->zoomx= intval(round($req->far_fl/$req->near_fl));
                                $ipc->h_angle_tele=$req->h_angle_tele;
                               }

    $ipc->streams=$req->streams;
    $ipc->codecs=$req->codecs;

    $ipc->power_type=$req->power_type;
    $ipc->power_consumption=$req->power_consumption;
    $ipc->lighttype_id=$req->lighttype_id;
    $ipc->light_distance=$req->light_distance;
    $ipc->mic=isset($req->mic);
    $ipc->audio_in=isset($req->audio_in);
    $ipc->audio_out=isset($req->audio_out);
    if (isset($req->alarm_in)) {$ipc->alarm_in=$req->alarm_in;}
    if (isset($req->alarm_out)) {$ipc->alarm_out=$req->alarm_out;}
    $ipc->high_temp=$req->high_temp;
    $ipc->low_temp=$req->low_temp;
    $ipc->protection_class=$req->protection_class;
    $ipc->micro_sd=$req->micro_sd;
    $ipc->is_archive=isset($req->is_archive);
    $ipc->is_eol=isset($req->is_eol);
    $ipc->wifi=isset($req->wifi);
    $ipc->fromprice_description=$req->fromprice_description;

    $ipc->save();
    if (isset($ipc->price)) {
      $ipc->price->rrc_price=$req->rrc_price;
      $ipc->price->save();}
    else {
      $ipc->price()->create(['rrc_price' => $req->rrc_price]);
          }


    return redirect()->route('ipc.one',$id)->with('success','Камера была отредактирована');
  }

public function cam_delete($id)
{
  $ipc=IPC::find($id);
  $pn=$ipc->pn;
  $ipc->price->delete();
  $ipc->delete();
  return redirect()->route('ipc.all')->with('success',"Камера {$pn} номер {$id} была удалена");
}
public function logout(Request $request)
{
   Auth::logout();

   $request->session()->invalidate();

   $request->session()->regenerateToken();

   return redirect('/');
}

}
