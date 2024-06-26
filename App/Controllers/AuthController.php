<?php
namespace App\Controllers;

use App\Controllers\Base\BaseController; 
use App\Core\Request;
use App\Models\User;
use App\Services\Auth\SessionAuth;

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
        redirectBack();
    }

    public function login(Request $request)
    {
        $request=$request->getParams();
        if(!User::login($request['email'],$request['password'], new SessionAuth() ))
            setFlashData('LoginError','Invalid credentials');
        return redirectBack();
    }
}