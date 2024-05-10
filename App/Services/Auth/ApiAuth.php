<?php
namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\Contracts\AuthenticationServiceContract;
use App\Services\Auth\Jwt\Jwt;

class ApiAuth implements AuthenticationServiceContract
{

    public function authenticate(array $credentials)
    {
        $user=User::where('email',$credentials['email'])->get();
        if(empty($user) || !$this->validate_user_name_and_password($user, $credentials['email'], $credentials['password']))
            return false;
        unset($user[0]->password); // prevent sending password to controller
        return $user[0];
    }

    protected function validate_user_name_and_password(array $user, string $email, string $password) :bool
    {
        if($user[0]->email == $email && $user[0]->password == hashPassword($password))
            return true;
        return false;
    }

}