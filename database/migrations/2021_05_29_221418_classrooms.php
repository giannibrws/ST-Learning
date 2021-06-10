<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Classroom;

class Classrooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('bio')->nullable();
            $table->string('created_by')->nullable();
            $table->integer('member_count')->default(0);
            // add foreign key relation:
            $table->foreignId('fk_user_id')->constrained('users')->onDelete('cascade');
            // Define publicity of classroom:
            $table->boolean('is_public')->default(1);
            $table->string('invitation_link')->default('http://127.0.0.1:8000/classrooms/'. $this->fetchToken());
            $table->timestamps();
        });
    }

    /**
     * Returns a unique randomized str token.
     */
    public function fetchToken()
    {
        $cr = new Classroom();
        return $cr->generateToken();
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
}
