<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Classroom extends Model
{
    use HasFactory;

    /*
     * @function: Create a new invitation token.
     * @return: invitation url for classrooms:
     * @info: check if token is unique if not regenerate token.
     */
    public function generateInvitationURL($classroom_id){
        $token = '';
        $url =  url('/') . '/classrooms/invite/';

        do {
            $token = str::random(10);
            $exists = filled(Classroom::where('invitation_link', 'like', '%' . $token . '%')->first());
        } while ($exists);

        $invitation_url = $url . $token;
        Classroom::where('id', $classroom_id)
        ->update(['invitation_link' => $invitation_url]);

        return $invitation_url;
    }


}
