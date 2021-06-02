<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class SubjectNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Has to have subjects first before it can be seeded:
        \App\Models\Notes::factory(10)->create();
    }
}
