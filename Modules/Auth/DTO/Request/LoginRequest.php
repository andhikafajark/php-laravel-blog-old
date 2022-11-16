<?php

namespace Modules\Auth\DTO\Request;

use App\DTO\DTO;

class LoginRequest extends DTO
{
    public string $username;
    public string $password;
    public string $token;
    public string $action;
}
