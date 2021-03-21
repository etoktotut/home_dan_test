<?php
namespace App\Dim ;

class IpcFilters extends QueryFilter
{
   // protected $builder;
   // protected $request;
   protected $is_stock=false; //is_stock - формировался ли запрос по складам stock_fill;
  protected $stock_list=[
    ['isOnstock','tot_t'],
    ['isOnMskStock','msk_t'],
    ['isOnSpbStock','spb_t'],
    ['isOnRstStock','rst_t']];
  protected $stocks_req=[];


 // public function __construct($builder,$request)
 // {
 //   $this->builder=$builder;
 //   $this->request=$request;
 // }



// public function apply()
//  {
//    foreach ($this->filters() as $filter => $value) {
//      if(method_exists($this,$filter)){
//        $this->$filter($value);
//      }
//    }
//   //$this->stocks_fill();
// //dd($this->builder);
//     return $this->builder;
// }

// public function filters()
// {
//   return $this->request->all();
// }

// создание сложных запросов по наличию на складах
public function stocks_fill()
{
// формируем массив из складов указанных в запросе stock_req
//( ищем в справочнике stock_list совпадения с именами в запросе и подставляем в массив соответствующие им значения полей бызы данных)
    foreach($this->filters() as $filter=>$value)
    {
      foreach ($this->stock_list as $key => $val)
       {
         if (in_array($filter, $val))
            {
              $this->stocks_req[]=$val[1];
            };
       };
    };

//
// если длина полученного массива (региональных складов) больше одного элемента, то формируем запрос типа where..для первого элемента. и orwhere для всех последующих
if (count($this->stocks_req) >= 1) {
   $this->builder->whereHas('stock', function ($query)
      {
// первый элемент запроса ("на определенном складе товара больше 0")
     $query->where($this->stocks_req[0],'>',0);
// цикл по последующим, начиная со второго элемента массива ( индекс = 1)
     for ($i = 1; $i < count($this->stocks_req); $i++) {
                                                           $query=$query->orWhere($this->stocks_req[$i],'>',0);
                                                        };
      });

   };
}

// Простые фильтры из главной базы данных

public function mp($value)
{
if ((int)$value > 0) {$this->builder->where('resolution_MP',(int)$value);}
}

public function vendor($value)
{
if ((int)$value > 0) {$this->builder->where('vendor_id',(int)$value);}
}

public function ipc_type($value)
{
if ((int)$value > 0) {$this->builder->where('type_id',(int)$value);}
}


public function lens_type($value)
{
if ((int)$value > 0) {$this->builder->where('lenstype_id',(int)$value);}
}

public function ir_chk($value)
{
$this->builder->where('light_distance','>=',(int)$this->request['ir_range']);
}

public function ang_chk($value)
{
$this->builder->where('h_angle_wide','>=',(int)$this->request['angle_range']);
}

public function mic($value)
{
$this->builder->where('mic',true);
}

public function vand($value)
{
$this->builder->where('protection_class','like',"%IK10%");
}

public function wifi($value)
{
$this->builder->where('wifi',true);
}

public function au_in($value)
{
$this->builder->where('audio_in',true);
}

public function au_out($value)
{
$this->builder->where('audio_out',true);
}

public function al_in($value)
{
$this->builder->where('alarm_in','>',0);
}

public function al_out($value)
{
$this->builder->where('alarm_out','>',0);
}

public function msd($value)
{
$this->builder->where('micro_sd','>',0);
}

public function is_eol($value)
{
  if ($value < 2) { $this->builder->where('is_eol','=',$value);};
}

public function is_project($value)
{
  if ($value < 2) { $this->builder->where('is_project','=',$value);};
}

public function pn_seek($value)
{
  $this->builder->where('pn','like',"%".$value."%");
}

public function isOnstock($value)
{
 if (!$this->is_stock) { $this->stocks_fill(); $this->is_stock=true;}
}

  public function isOnMskStock($value)
 {
   if (!$this->is_stock) { $this->stocks_fill(); $this->is_stock=true;}
 }

 public function isOnSpbStock($value)
 {
   if (!$this->is_stock) { $this->stocks_fill(); $this->is_stock=true;}
 }

 public function isOnRstStock($value)
 {
   if (!$this->is_stock) { $this->stocks_fill(); $this->is_stock=true;}
 }


// $this->builder->whereHas('stock', function ($query) use ($value){
//   $query->where('msk_t','>',0);
//   dd($query);
// });

//
// public function is_archive($value)
// {
//   $this->builder->where('is_archive',$value);
//
// }
//

}
