<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Has to have classrooms first before it can be seeded:
        \App\Models\Subjects::factory(3)->create();
    }
}
