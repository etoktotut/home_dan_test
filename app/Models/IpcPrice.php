<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpcPrice extends Model
{
    protected $fillable=['rrc_price'];
    use HasFactory;

   // public function ipc()
   //   {
   //       return $this->belongsTo('App\Models\IPC','ipc_id','ipc');
   //   }
}
