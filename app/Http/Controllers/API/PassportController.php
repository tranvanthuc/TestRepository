<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\User;

class PassportController extends Controller
{
    public $successStatus = 200;
    // login
    public function login()
    {
        $email = request('email');
        $password = request('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(compact('success'), $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    // register
    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = request()->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(compact('success'), $this->successStatus);
    }

    // get details
    public function getDetails()
    {
        $user = Auth::user();
        return response()->json(['success'=> $user], $this->successStatus);
    }

    /**
     * authenticated
     */
    protected function authenticated(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        
        $response = $http->post(env('APP_URL') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => env('PASSWORD_CLIENT_ID'),
                'client_secret' => env('PASSWORD_CLIENT_SECRET'),
                'username' => $request['username'],
                'password' => $request['password'],
                'scope' => '',
            ],
        ]);
        
        return $this->success(json_decode((string) $response->getBody(), true));
    }
}
