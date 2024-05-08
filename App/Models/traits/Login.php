<?php
namespace App\Models\traits;

use App\Models\User;

trait Login
{
    public static function login(string $email,string $password):bool
    {
        $user=User::where('email',$email)->get();
        if(empty($user))
            return false;
        if(!$user[0]->email == $email && $user[0]->pasword == hashPassword($password))
            return false;
        setUserSessionData($user[0]);
        return true;
    }
}