<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $user = new \App\Models\User();
      $user->password = bcrypt('1111111a');
      $user->name='admin';
      $user->email = 'admin@danuna.net';
      $user->save();
          }
}
