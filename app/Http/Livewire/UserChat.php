<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Messages;
use App\Models\User;
use App\Models\ClassroomUser;
use App\Http\Controllers\UserController;

class UserChat extends Component
{

    public $linked_users;
    public $is_visible = false;
    public $users;
    public $userProfilePhotos;
    public $messages;
    public $classroom_id;


    // Livewire constructor:
    public function mount($classroom_id)
    {
       $this->classroom_id = $classroom_id;
       $this->messages = '';
       $this->linked_users = $this->getLinkedUsers($this->classroom_id);
       $this->userProfilePhotos = [];

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

    // Toggle chat & messages:
    public function displayUserChat(){
        $this->messages = Messages::all();

        if(!$this->is_visible){
            $this->is_visible = true;
        }
        else{
            $this->is_visible = false;
        }
    }

    public function hideUserChat(){
        $this->messages = '';
    }

    public function render()
    {
        return view('livewire.user-chat');
    }

    public function getLinkedUsers($cr_id){
        $linkedIDs = ClassroomUser::where('classroom_id', $cr_id)->get();
        // Fetches the ids from the dataset:
        $plucked = $linkedIDs->pluck('user_id')->all();
        return User::whereIn('id', $plucked)->get();
    }

}
