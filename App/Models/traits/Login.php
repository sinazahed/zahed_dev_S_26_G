<?php
namespace App\Models\traits;

use App\Models\User;
use App\Services\Auth\AuthenticationManager;
use App\Services\Auth\Contracts\AuthenticationServiceContract;
use PhpParser\Node\Expr\Cast\Object_;

trait Login
{
    public static function login(string $email, string $password , AuthenticationServiceContract $auth)
    {   
        $auth = new AuthenticationManager($auth);
        return $auth->authenticate(['email'=>$email,'password'=>$password]);
    }
}