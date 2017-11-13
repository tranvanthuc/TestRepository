<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use GuzzleHttp;
use App\User;

class PassportController extends Controller
{

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
        return $this->success($user);
    }

    /**
     * get current user
     */
    public function me()
    {
        $user = Auth::user();
        return $this->success($user);
    }

    /**
     * login
     */
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        
        $response = $http->post(env('APP_URL') . '/oauth/token', [
            'form_params' => [
                'username' => $request['username'],
                'password' => $request['password'],
                'grant_type' => 'password',
                'client_id' => env('PASSWORD_CLIENT_ID'),
                'client_secret' => env('PASSWORD_CLIENT_SECRET'),
                'scope' => '',
            ],
        ]);
        
        return $this->success(json_decode((string) $response->getBody(), true));
    }

    /**
     * refresh token
     */
    public function refreshToken(Request $request)
    {
        $http = new GuzzleHttp\Client;
        
        $response = $http->post(env('APP_URL') . '/oauth/token', [
            'form_params' => [
                'refresh_token' => $request['refresh_token'],
                'grant_type' => 'refresh_token',
                'client_id' => env('PASSWORD_CLIENT_ID'),
                'client_secret' => env('PASSWORD_CLIENT_SECRET'),
                'scope' => '',
            ],
        ]);
        
        return $this->success(json_decode((string) $response->getBody(), true));
    }

    /**
     * redirect
     */
    public function redirect()
    {
        $query = http_build_query([
            'client_id' => env('PASSWORD_CLIENT_ID'),
            'redirect_uri' => env('APP_URL').'register',
            'response_type' => 'token',
            'scope' => '',
        ]);
    
        return redirect(env('APP_URL') .'/oauth/authorize?'.$query);
    }
}
