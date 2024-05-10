<?php
namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\Contracts\AuthenticationServiceContract;

class SessionAuth implements AuthenticationServiceContract
{

    public function authenticate(array $credentials) : bool
    {
        $user=User::where('email',$credentials['email'])->get();
        if(empty($user) || !$this->validate_user_name_and_password($user, $credentials['email'], $credentials['password']))
            return false;
        setUserSessionData($user[0]);
        return true;
    }

    protected function validate_user_name_and_password(array $user, string $email, string $password) :bool
    {
        if($user[0]->email == $email && $user[0]->password == hashPassword($password))
            return true;
        return false;
    }

}