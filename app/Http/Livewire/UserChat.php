<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\ClassroomUser;
use App\Models\Messages;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserChat extends Component
{

    public $linkedUsers;
    public $is_visible = false;
    public $users;
    public $userProfilePhotos;
    public $classroom_id;
    public $message_body;
    public $showErrors = false;
    public $errorMsg = '';

    protected $listeners = ['saveMessage' => '$refresh'];


    // Livewire constructor:
    public function mount($classroom_id)
    {
       $this->classroom_id = $classroom_id;
       $this->linkedUsers = $this->getLinkedUsers($this->classroom_id);

       $this->userProfilePhotos = [];
       $this->linkProfilePhotos();
       $this->showErrors = false;


    }

    // Toggle chat & messages:
    public function displayUserChat(){
        if(!$this->is_visible){
            $this->is_visible = true;
        }
        else{
            $this->is_visible = false;
        }
        $this->mount($this->classroom_id);
    }

    public function render()
    {
        return view('livewire.user-chat');
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

        foreach ($this->linkedUsers as $user){

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

    public function saveMessage(){

        if(!empty($this->message_body)){

            if(strlen($this->message_body) <= 500){
                $this->showErrors = false;

                $this->emit('store', $this->message_body);
                $this->message_body = '';
                $this->dispatchBrowserEvent('message_added');

            }

            else{
                $this->showErrors = true;
                $this->errorMsg = 'Error: Max Message size is 500 characters!';
            }
        }
    }
}
