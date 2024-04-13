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
    }

    function update(Request $req){
        $dev = device::find($req->id);
        $dev->name = $req->name;
        $dev->member_id = $req->member_id;
        $result = $dev->save();
        if($result){
            return ["Result"=>"Data has been updated"];
        }

        else{
            return ["Result"=>"Operation failed"];
        }
    }

    function search($name){
        return device::where("name","like","%".$name."%")->get();
    }

    function delete($id){
        $dev = device::find($id);
        $result = $dev->delete();
        if($result){
            return ["result"=>"record has been deleted"];
        }
        else{
            return ["result"=>"delete operation failed"];
        }
    }
}
