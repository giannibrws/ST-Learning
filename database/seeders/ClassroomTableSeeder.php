<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClassroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 random user accounts:
        \App\Models\Classroom::factory(10)->create();
    }
}
