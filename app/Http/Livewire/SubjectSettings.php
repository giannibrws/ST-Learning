<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Classroom;

class SubjectSettings extends Component
{

    public $interactWith;
    public $subject;
    public $invitation_link;
    public $advancedOptions;

    protected $listeners = ['collapseSettings' => '$refresh'];

    public function mount(){
        $this->interactWith = false;
        $this->advancedOptions = false;
    }

    public function render()
    {
        return view('livewire.subject-settings');
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

    public function closeInteraction(){
        $this->interactWith = false;
    }

}
