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
    
    //for single data push

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


    //update
    function update(Request $req){

        // Get the device ID from the request body
        $requestDeviceId = $req->input('id');

        // Find the device by ID
        $device = device::find($requestDeviceId);

        // Check if the device exists
        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }
       

        else{
                // validate
            $validator = Validator::make($req->input(),[
                'name' => 'required|max:255|min:2',
                'member_id' => 'required|integer|max:255|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            
            else{
                $dev = device::find($req->id);
                $dev->name = $req->name;
                $dev->member_id = $req->member_id;
                $result = $dev->save();    

                return response()->json(['message' => 'Device Updated successfully'], 200);
            }
        }
        
    }

    function search($name){
        return device::where("name","like","%".$name."%")->get();
    }

    //delete
    function delete(Request $request, $id){

        //Does the resouce exit
        $request->validate([
            'id' => 'exists:devices,id', // Assuming devices table and ID field
        ]);

        //Find device by ID
        $dev = device::find($id);

        //If no device then return failure json message
        if (!$dev) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        //Delete the device
        $result = $dev->delete();

        // Return a JSON response indicating success
        
        if($result){
            return response()->json(['message' => 'Device deleted successfully'], 200);
        }
        
        else{
            return ["result"=>"delete operation failed"];
        }
    }

    // for both single and multple data push
    public function store(Request $request)
    {
        
        //decoding json to array
        $data=json_decode($request->getContent(),true);
        
        // Validate the incoming multi_request data
        
        $validator = Validator::make($data,[
            '*.name' => 'required|max:255|min:2',
            '*.member_id' => 'required|integer|max:255|min:1',
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
