<?php
namespace App\Controllers\Api\V1;

use App\Controllers\Base\BaseController; 
use App\Core\Request;
use App\Models\User;
use App\Services\Auth\ApiAuth;

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
}