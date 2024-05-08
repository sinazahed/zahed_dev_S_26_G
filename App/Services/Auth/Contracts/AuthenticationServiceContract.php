<?php

namespace App\Services\Auth\Contracts;

interface AuthenticationServiceContract
{
    public function authenticate(array $credentials);
}