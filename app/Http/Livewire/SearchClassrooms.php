<?php

namespace App\Http\Livewire;

use App\Models\Classroom;
use Livewire\Component;

class SearchClassrooms extends Component
{

    public $query;
    public $classrooms;

    public function render()
    {
        return view('livewire.search-classrooms');
    }

    public function mount(){

        $this->query = '';
    }

    public function onUpdate(){
        $this->classrooms = Classroom::where('name', 'like', '%', $this->query . '%')->get();

    }


}
