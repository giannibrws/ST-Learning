<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Messages;
use App\Models\User;
use App\Http\Controllers\UserController;

class UserChat extends Component
{

    public $linked_users;
    public $is_visible = false;

    public $users;
    public $userProfilePics;
    public $messages;


    // Livewire constructor:
    public function mount()
    {
       $this->messages = '';

        $userProfilePhotos = [];
        // fetch all data
        $userManager = new UserController();

//        foreach ($linked_users as $user){
//            $defaultPhotoPath = $userManager->getDefaultProfilePhotoUrl($user->id);
//            array_push($userProfilePhotos, $defaultPhotoPath);
//        }


    }

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


    public function getDefaultProfilePhotoUrl($user_id)
    {
        $currentUserName = DB::table($this->table)->where('id', '=', $user_id)->first()->name;
        return 'https://ui-avatars.com/api/?name='.urlencode($currentUserName).'&color=7F9CF5&background=EBF4FF';
    }

    public function getLinkedUsers($cr_id){

        $linkedIDs = ClassroomUser::where('classroom_id', $cr_id)->get();
        // Fetches the ids from the dataset:
        $plucked = $linkedIDs->pluck('user_id')->all();

        return User::whereIn('id', $plucked)->get();
    }




}
