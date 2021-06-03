<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'name' => 'Magnetisch veld',
                'content' => 'testetesteststsetse',
                'fk_subject_id' => '1',
                'fk_user_id' => '1'
            ]
        ];

        DB::table('notes')->insert($records);

        // Has to have subjects first before it can be seeded:
        \App\Models\Notes::factory(10)->create();
    }
}
