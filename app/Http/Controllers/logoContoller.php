<?php

namespace App\Http\Controllers;

use App\Models\head_logo;
use App\Models\slider;
use Illuminate\Http\Request;

class logoContoller extends Controller
{
    function show(Request $request){
        $logo = head_logo::first();
        $imagePath = $logo ? asset('storage/' . $logo->path) : null;
        logger($imagePath); // Log the image path

        // Retrieve sliders ordered by seqNo
        $sliders = slider::orderBy('seqNo')->get();

        return view('welcome', [
            'imagePath' => $imagePath,
            'logok' => $logo ? $logo->logolink : null,
            'sliders' => $sliders,
        ]);
    }
    
}
