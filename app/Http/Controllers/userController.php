<?php

namespace App\Http\Controllers;

use App\Models\device;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    function index(Request $request){
        $user= User::where('email', $request->email)->first();
        //print_r($data);
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message'=>['These credentials do not match our records']
            ], 404);
        }
        $token=$user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    function listView(): View
    {
        // $data = device::all(); // Fetch all data from the database
        return view('listView', [
            'devices' => DB::table('devices')->simplePaginate(15),
            // 'data' => $data
        ]);
        
    }
    

}
