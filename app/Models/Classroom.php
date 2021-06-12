<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Classroom extends Model
{
    use HasFactory;


    public function generateToken(){
        return str::random(10);
    }

    /*
     * @function: Create a new invitation token.
     * @info: check if token is unique if not regenerate token.
     */
    public function updateToken($classroom_id){
        $token = '';
        $url = 'http://127.0.0.1:8000/classrooms/invite/';
        do {
            $token = str::random(10);
            $exists = filled(Classroom::where('invitation_link', 'like', '%' . $token . '%')->first());
        } while ($exists);

        $url = $url . $token;
        Classroom::where('id', $classroom_id)
        ->update(['invitation_link' => $url]);


        return $token;
    }


}
