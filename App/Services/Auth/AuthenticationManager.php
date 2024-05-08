<?php
namespace App\Services\Auth;

use App\Services\Auth\Contracts\AuthenticationServiceContract;
use App\Services\Auth\DefaultAuthenticationService;

class AuthenticationManager
{
    protected $authenticationService;

    public function __construct(AuthenticationServiceContract $authenticationService)
    {
        $this->authenticationService=$authenticationService;
    }

    public function authenticate(array $credentials)
    {
        return $this->authenticationService->authenticate($credentials);
    }
}