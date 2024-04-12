<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiController1 extends Controller
{
    function getData(){
        return ["name"=>"anil"];
    }
}
