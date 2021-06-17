<?php

namespace App\Http\Livewire;

use App\Models\Classroom;
use Livewire\Component;
use App\Models\ClassroomUser;

class SearchClassrooms extends Component
{

    public $query;

    public function render()
    {
        return view('livewire.search-classrooms');
    }

    public function mount(){
        $this->query = '';
    }

    public function onUpdate(){

    }

}
