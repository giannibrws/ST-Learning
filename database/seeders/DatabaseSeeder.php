<?php

namespace Database\Seeders;

use App\Models\ClassroomUser;
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

        // @info: Seeding order is VERY important, make sure to seed dependency tables first.

        $this->call([
            UserTableSeeder::class,
            ClassroomTableSeeder::class,
            SubjectTableSeeder::class,
            SubjectNoteSeeder::class,
            ClassroomUserSeeder::class,
            UserMessagesSeeder::class,
//            PostSeeder::class,
//            CommentSeeder::class,
        ]);

    }
}
