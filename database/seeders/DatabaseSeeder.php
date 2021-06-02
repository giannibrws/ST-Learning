<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            UserTableSeeder::class,
            ClassroomTableSeeder::class,
            SubjectTableSeeder::class,
            SubjectNoteSeeder::class,
//            PostSeeder::class,
//            CommentSeeder::class,
        ]);

    }
}
