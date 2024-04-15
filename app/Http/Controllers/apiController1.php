<?php

namespace App\Http\Controllers;

use App\Models\device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use PhpParser\Node\Stmt\Return_;

class apiController1 extends Controller
{
    function getData(){
        return ["name"=>"anil"];
    }
    function list($id=null){
        return $id?device::find($id):device::all();
    }
    

    // function add(Request $req){

    //     $dev = new device();
    //     $dev->name=$req->name;
    //     $dev->member_id=$req->member_id;
    //     $result=$dev->save();

    //     if($result){
    //         return ["Result"=>"Data has been saveds"];
    //     }

    //     else{
    //         return ["Result"=>"Operation failed"];
    //     }
    // }


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

    // function testData(Request $req){
    //     $valid = array(
    //         'name'=> [
    //             'required',
    //             'string',
    //             'min:2',
    //             'max:35',
    //             Rule::unique('devices'),
    //         ],
    //         'member_id'=>[
    //             'required',
    //             'integer',
    //             'min:1',
    //             'max:200',
    //             Rule::unique('devices'),
    //         ],
    //     );

    //     $validator = Validator::make($req->all(),$valid);

    //     if($validator->fails()){
    //         return response()->json($validator->errors(),401);
    //     }
    //     else{

    //         device::create($validator->validated());
    //         // $dev = new device();
    //         // $dev->name=$req->name;
    //         // $dev->member_id=$req->member_id;
    //         // $result=$dev->save();

    //         return response()->json(['message' => 'Device created successfully'], 201);
    //     }
    //     // return ["Message", $req->name];

    // }
    public function store(Request $request)
    {
        
        //decoding json to array
        $data=json_decode($request->getContent(),true);
        
        // Validate the incoming multi_request data
        
        $validator = Validator::make($data,[
            '*.name' => 'required|max:255',
            '*.member_id' => 'required|integer|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),401);
        }
        else{

            foreach($data as $vdata){
                device::create($vdata);
             }
            
            return response()->json(['message' => 'Device created successfully'], 201);
        }
                
    }
}
