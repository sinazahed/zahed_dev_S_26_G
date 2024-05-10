<?php
namespace App\Controllers\Api\V1;

use App\Controllers\Base\BaseController; 
use App\Core\Request;
use App\Models\User;
use App\Services\Auth\ApiAuth;
use App\Services\Auth\Jwt\Jwt;

class AuthController extends BaseController
{

    public function register(Request $request)
    {
        $request=$request->getParams();
        User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>hashPassword($request['password'])
        ]);
        return json($request,200);
    }

    public function login(Request $request)
    {
        $request=$request->getParams();
        $user = User::login($request['email'],$request['password'], new ApiAuth() );
        if(!$user)
            return json(['error'=>'Invalid creadinals'],200);
        return json([
            'name'=>$user->name,
            'token'=> Jwt::encode($user,'sha256')
        ],200);
    }
}