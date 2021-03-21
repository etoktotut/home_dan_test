<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\IPC;
use \App\Models\IpcPrice;

class IpcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
      IPC::truncate();

      IpcPrice::truncate();

      IPC::factory(12)->create()->each( function ($ipc){
         IpcPrice::factory()->create([
           'ipc_id'=> $ipc->id
        ]);
      });
    }
}
