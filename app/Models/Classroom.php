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
    public function updateToken(){
        $token = '';
        do {
            $token = str::random(10);
            $exists = filled(Classroom::where('invitation_link', 'like', '%' . $token . '%')->first());
        } while ($exists);

        return $token;
    }


}
