<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Messages::factory(10)->create();
    }

}
