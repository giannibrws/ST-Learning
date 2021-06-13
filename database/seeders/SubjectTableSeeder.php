<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
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
        $records = [
            [
                'name' => 'VScode plugins',
                'bio' => 'Plugin support for react native',
                'fk_classroom_id' => '1',
                'fk_user_id' => '1'
            ]
        ];

        DB::table('subjects')->insert($records);

        // Has to have classrooms first before it can be seeded:
        \App\Models\Subjects::factory(3)->create();
    }
}
