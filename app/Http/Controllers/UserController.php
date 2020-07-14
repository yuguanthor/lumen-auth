<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class UsersController extends Controller
{

    public function __construct()
    {

        //  $this->middleware('auth:api');



    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        /**Take note of this: Your user authentication access token is generated here **/
        $data['token'] =  $user->createToken('MyApp')->accessToken;
        $data['name'] =  $user->name;

        return response(['data' => $data, 'message' => 'Account created successfully!', 'status' => true]);
    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function authenticate(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = Users::where('email', $request->input('email'))->first();

        if (Hash::check($request->input('password'), $user->password)) {

            $apikey = base64_encode(str_random(40));

            Users::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);

            return response()->json(['status' => 'success', 'api_key' => $apikey]);

        } else {

            return response()->json(['status' => 'fail'], 401);

        }

    }

}
