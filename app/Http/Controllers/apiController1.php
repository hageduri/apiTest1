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

    function add(Request $req){

        $dev = new device();
        $dev->name=$req->name;
        $dev->member_id=$req->member_id;
        $result=$dev->save();

        if($result){
            return ["Result"=>"Data has been saveds"];
        }

        else{
            return ["Result"=>"Operation failed"];
        }

        // $validatedData = $req->validate([
        //     'name' => 'required|string|max:255',
        //     'member_id' => 'required|integer',
        // ]);

        // $myData = new device();
        // $myData->name = $validatedData['name'];
        // $myData->member_id = $validatedData['member_id'];
        // $myData->save();

        // return response()->json(['message' => 'Data inserted successfully'], 201);

        // return ["Result"=>"Data has been saveds"];
    }
}
