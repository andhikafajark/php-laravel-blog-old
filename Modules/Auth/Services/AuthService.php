<?php

namespace Modules\Auth\Services;

use Modules\Auth\DTO\Request\LoginRequest;

interface AuthService
{
    public function login(LoginRequest $loginRequest): bool;
}
