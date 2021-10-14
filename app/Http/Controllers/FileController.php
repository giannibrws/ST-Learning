<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\Notes;
use Illuminate\Http\Request;

class FileController extends Controller
{

    //
    public function store(Request $request)
    {

        $note = new Note();
        $note->id = 300;
        $image = $note->addMediaFromRequest('upload')->toMediaCollection('images');

        // $path_url = 'storage/' . Auth::id();

        // if ($request->hasFile('upload')) {
        //     $originName = $request->file('upload')->getClientOriginalName();
        //     $fileName = pathinfo($originName, PATHINFO_FILENAME);
        //     $extension = $request->file('upload')->getClientOriginalExtension();
        //     $fileName = Str::slug($fileName) . '_' . time() . '.' . $extension;
        //     $request->file('upload')->move(public_path($path_url), $fileName);
        //     $url = asset($path_url . '/' . $fileName);
        // }
  
        return response()->json([
            'url' => $image->getUrl()
        ]);
    }

}
