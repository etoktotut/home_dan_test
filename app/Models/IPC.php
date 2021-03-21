<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPC extends Model
{
  protected $table='ipcs';

    use HasFactory;

    public function vendor()
    {
      return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function ipctype()
    {
      return $this->belongsTo(Ipctype::class,'type_id');
    }
    public function lenstype()
    {
      return $this->belongsTo('App\Models\Lenstype','lenstype_id');
    }
    public function lighttype()
    {
      return $this->belongsTo('App\Models\Lighttype','lighttype_id');
    }

    public function price()
    {
      return $this->hasOne(IpcPrice::class,'ipc_id');
    }

    public function stock()
    {
      return $this->hasOne(Stock::class,'ipc_id');
    }
// при фильтрации вызываем этот метод отбрасывая "scope" как "->filters()" - например IPC::with('stock','price')->filter($filters) 
    public function scopeFilter($builder,$filters)
    {
      return $filters->apply($builder);
    }
}
