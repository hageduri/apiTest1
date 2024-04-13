<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\device;

class apiController1 extends Controller
{
    function getData(){
        return ["name"=>"anil"];
    }
    function list($id=null){
        return $id?device::find($id):device::all();
    }
}
