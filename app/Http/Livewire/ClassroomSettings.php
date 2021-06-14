<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Classroom;

class ClassroomSettings extends Component
{

    public $interactWith;
    public $classroom;
    public $invitation_link;
    public $advancedOptions;


    protected $listeners = ['collapseSettings' => '$refresh'];

    public function mount(){
        $this->invitation_link = $this->classroom->invitation_link;
        $this->interactWith = false;
        $this->advancedOptions = false;
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

    public function toggleAdvanced(){
        // toggle between states:
        if(!$this->advancedOptions){
            $this->advancedOptions = true;
        }
        else{
            $this->advancedOptions = false;
        }
    }


    public function updateLink(){
        $c = new Classroom();
        $invitation_url = $c->generateInvitationURL($this->classroom->id);
        $this->invitation_link = $invitation_url;
    }

    public function closeInteraction(){
        $this->interactWith = false;
    }

}
