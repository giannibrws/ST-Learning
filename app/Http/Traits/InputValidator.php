<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait InputValidator
{

    protected function validateInput(Request $request){

        foreach ($request->input() as $key => $field){
            if($key !== "_token" || $key !== "_method"){
                // if textarea:
                if($key == "content"){
                    $request->validate([$key => 'required|max:1000'],
                        [
                            $key . '.required' => 'Field ' . $key . ' is required',
                            $key . '.max' => 'Field ' . $key . ' is too long. Max 1000 characters allowed!',
                        ]);
                }
                elseif(strpos($key, 'bio') !== false){
                    $request->validate([$key => 'max:500'],
                        [
                            $key . '.max' => 'Field ' . $key . ' is too long. Max 500 characters allowed!',
                        ]);
                }
                else{
                    $request->validate([$key => 'required|max:255'],
                        [
                            $key . '.required' => 'Field ' . $key . ' is required',
                            $key . '.max' => 'Field ' . $key . ' is too long. Max 255 characters allowed!',
                        ]);
                }
            }
        }
    }

}