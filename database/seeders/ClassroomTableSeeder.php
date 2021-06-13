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
            'name' => 'React Native',
            'bio' => 'Alles over React Native',
            'member_count' => '10',
            'created_by' => 'Gianni',
            'fk_user_id' => '1'
            ]
        ];

        DB::table('classrooms')->insert($records);

        // create 10 random user accounts:
        \App\Models\Classroom::factory(10)->create();
    }
}
