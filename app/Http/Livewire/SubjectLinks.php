<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LinkedUrls;


class SubjectLinks extends Component
{
    // properties:
    public $subject;
    public $subject_id;
    public $linkedUrls = [];
    public $url_name = '';
    public $url = '';

    public function mount($subject){
        $this->subject_id = $subject->id;
        $this->linkedUrls = LinkedUrls::where('subject_id', '=', $this->subject_id)->get();
    }

    public function render()
    {
        return view('livewire.subject-links');
    }

    public function store()
    {
        if(true){
            $linkedUrl = new LinkedUrls();
            $linkedUrl->url_name = $this->url_name;
            $linkedUrl->url = $this->url;
            $linkedUrl->subject_id = $this->subject_id;
            // Store data:
            $linkedUrl->save();
            // reset:
            $this->cleanVars();
            $this->mount($this->subject);
        }
    }

    protected function cleanVars(){
        $this->url_name = '';
        $this->url = '';
    }

    public function destroy($id){
        LinkedUrls::where('id',$id)->delete();
        $this->mount($this->subject);
    }

}
