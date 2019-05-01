<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login(Request $request){

      $this->validate($request,
       [  'email'=> 'required',
          'password'=> 'required'
        ]);

        $user = User::where('email',$request->email)->first();
        if(!$user){
          return response()->json(['data'=>'The email invalid ']);
        }

        if(Hash::check($request->password,$user->password)){

           $http = new Client;
          $response = $http->post('http://passport.test/oauth/token', [
              'form_params' => [
                  'grant_type' => 'password',
                  'client_id'  => '2',
                  'client_secret' => 'MruHGSDOScFO5monT016WsoCVH3ufxNHWnb0lkla',
                  'username' => $request->email,
                  'password' => $request->password,
                  'scope'    => '',
              ],
          ]);
      return json_decode((string) $response->getBody(), true);
        }
    }


    public function register(Request $request){

      $this->validate($request,
       [   'name' => 'required',
          'email'=> 'required',
          'password'=> 'required'
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $user  = User::create($input);


        $http = new Client;


        $response = $http->post('http://passport.test/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id'  => '2',
                'client_secret' => 'MruHGSDOScFO5monT016WsoCVH3ufxNHWnb0lkla',
                'username' => $request->email,
                'password' => $request->password,
                'scope'    => '',
            ],
    ]);

    return json_decode((string) $response->getBody(), true);
  }
}
