<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Models\Messages;
use Illuminate\Support\Facades\DB;
use App\Models\ClassroomUser;

class UserMessages extends Component
{
    public $linked_users;
    public $classroom_id;
    public $userProfilePhotos;
    public $messages = [];

    protected $listeners = [
        'store'
    ];

    public function store($message_body){

            $message = new Messages();
            $message->body = $message_body;
            $message->user_id = auth()->id();
            $message->classroom_id = $this->classroom_id;
            $message->save();
            $this->refreshMessages();

    }

    public function refreshMessages(){
       $this->mount($this->classroom_id);
    }

    public function mount($classroom_id)
    {
        $this->classroom_id = $classroom_id;
        $this->messages = Messages::where('classroom_id', $classroom_id)->get();
        $this->linked_users = $this->getLinkedUsers($this->classroom_id);

        $this->userProfilePhotos = [];
        $this->linkProfilePhotos();
    }

    public function render()
    {
        return view('livewire.user-messages');
    }

    public function getLinkedUsers($cr_id){
        // first join both tables then use where clause:
        $users = DB::table('users')->select('users.id', 'classroom_users.classroom_id', 'name', 'email', 'profile_photo_path', 'role')
            ->join('classroom_users', 'users.id', '=', 'classroom_users.user_id')
            ->where('classroom_users.classroom_id', '=' , $cr_id)
            ->get();

        return $users;
    }

    public function linkProfilePhotos(){
        // fetch all data
        $userManager = new UserController();

        foreach ($this->linked_users as $user){
            $defaultPhotoPath = $userManager->getDefaultProfilePhotoUrl($user->id);
            $userProfile = ([
                'user_id' => $user->id,
                'picture' => $defaultPhotoPath,
            ]);

            array_push($this->userProfilePhotos, $userProfile);
        }
        // Link id to picture:
        foreach ($this->userProfilePhotos as $idx => $value){
            $this->userProfilePhotos[$value["user_id"]] = $value["picture"];
        }
    }
}
