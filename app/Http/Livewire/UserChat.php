<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\ClassroomUser;
use App\Models\Messages;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

class UserChat extends Component
{
    public $admins;
    public $linked_users;
    public $is_visible = false;
    public $users;
    public $userProfilePhotos;
    public $classroom_id;
    public $message_body;
    public $scrollHeight = 0;
    public $showErrors = false;
    public $errorMsg = '';

    protected $listeners = ['saveMessage' => '$refresh'];


    // Livewire constructor:
    public function mount($classroom_id)
    {
       $this->classroom_id = $classroom_id;
       $this->linked_users = $this->getLinkedUsers($this->classroom_id);
       $this->admins = $this->getAdmins($this->classroom_id);

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
    }

    public function render()
    {
        return view('livewire.user-chat');
    }

    public function getAdmins($cr_id){
        $admins = ClassroomUser::where('classroom_id', '=', $cr_id)->where('is_admin', '=', 1)->get();
        // Fetches the ids from the dataset:
        $plucked = $admins->pluck('user_id')->all();
        return User::whereIn('id', $plucked)->get();
    }

    public function getLinkedUsers($cr_id){
        $linkedIDs = ClassroomUser::where('classroom_id', $cr_id)->where('is_admin', '=', 0)->get();
        // Fetches the ids from the dataset:
        $plucked = $linkedIDs->pluck('user_id')->all();
        return User::whereIn('id', $plucked)->get();
    }

    public function linkProfilePhotos(){
        // fetch all data
        $userManager = new UserController();

        // merge all users:
        $users = $this->admins->merge($this->linked_users);

        foreach ($users as $user){

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
