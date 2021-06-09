<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ConnectedApps as ClassroomApps;

class ConnectedApps extends Component
{
    public $classroom_id;
    public $connectApp;
    public $interactWith = false;
    public $connectedApps = [];
    public $app_types = ['discord', 'gdrive'];
    public $selected_idx;

    // properties:
    public $app_type = 'discord';
    public $webhook_url;
    public $app_name;
    public $app_index;

    public function mount(){
        $this->connectApp = false;
        $this->connectedApps = ClassroomApps::where('classroom_id', $this->classroom_id)->get();
    }

    public function render()
    {
        return view('livewire.connected-apps');
    }

    public function store()
    {

        if(in_array($this->app_type, $this->app_types)){

            $webhook_url = htmlspecialchars($this->webhook_url);
            $classroomApp = new ClassroomApps();
            $classroomApp->type = $this->app_type;
            $classroomApp->name = $this->app_name;
            $classroomApp->webhook_url = $webhook_url;
            $classroomApp->classroom_id = $this->classroom_id;
            // Store data:
            $classroomApp->save();
            // reset:
            $this->cleanVars();
            $this->mount();
    }


    }

    protected function cleanVars(){
        $this->app_type = '';
        $this->app_name = '';
        $this->webhook_url = '';
    }

    public function connectApp(){
        $this->connectApp = true;
    }

    public function interactWith($key){
        $this->interactWith = true;
        $this->selected_idx = $key;
    }

    public function closeInteraction(){
        $this->interactWith = false;
    }

    public function destroy($id){
        ClassroomApps::where('id',$id)->delete();
        $this->interactWith = false;
        $this->mount();
    }

}
