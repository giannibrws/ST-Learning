<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
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

        $records = [
            [
            'name' => 'Scheikunde',
            'bio' => 'Scheikunde les voor klas 2',
            'fk_user_id' => '1'
            ]
        ];

        DB::table('classrooms')->insert($records);

        // create 10 random user accounts:
        \App\Models\Classroom::factory(10)->create();
    }
}
