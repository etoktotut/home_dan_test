<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // \App\Models\User::factory(10)->create();
          Contact::truncate();
          Contact::factory(10)->create();
    }
}
