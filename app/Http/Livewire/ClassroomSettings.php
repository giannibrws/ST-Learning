<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Classroom;

class ClassroomSettings extends Component
{

    public $interactWith;
    public $classroom;
    public $invitation_link;


    protected $listeners = ['collapseSettings' => '$refresh'];

    public function mount(){
        $this->invitation_link = $this->classroom->invitation_link;
        $this->interactWith = false;
    }

    public function render()
    {
        return view('livewire.classroom-settings');
    }

    public function interactWith(){
        // toggle between states:
        if(!$this->interactWith){
            $this->interactWith = true;
        }
        else{
            $this->interactWith = false;
        }
    }

    public function updateLink(){
        $c = new Classroom();
        $token = $c->updateToken();
        $this->invitation_link = 'http://127.0.0.1:8000/classrooms/invite/' . $token;
    }

    public function closeInteraction(){
        $this->interactWith = false;
    }

}
