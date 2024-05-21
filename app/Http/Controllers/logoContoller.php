<?php

namespace App\Http\Controllers;

use App\Models\head_logo;
use Illuminate\Http\Request;

class logoContoller extends Controller
{
    function show(Request $request){
        $logo = head_logo::first();
        $imagePath = $logo ? asset('storage/' . $logo->path) : null;
        logger($imagePath); // Log the image path

        return view('welcome', [
            'imagePath' => $imagePath,
            'logok' => $logo ? $logo->logolink : null,
        ]);
    }
    
}
