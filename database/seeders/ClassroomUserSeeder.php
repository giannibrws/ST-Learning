<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ClassroomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];

        // for ids 1 to 10
        for($k = 1; $k <= 10; $k++){

            $is_admin = 0;

            if($k == 0){
                $is_admin = 1;
            }

            $val =   [
                'user_id' => $k,
                'classroom_id' => rand(1,1),
                'is_admin' => $is_admin
            ];
            array_push($records, $val);
        }

        DB::table('classroom_users')->insert($records);
    }
}
