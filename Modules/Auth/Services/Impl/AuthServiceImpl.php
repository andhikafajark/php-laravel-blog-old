<?php

namespace Modules\Auth\Services\Impl;

use App\Exceptions\BadRequestException;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\DTO\Request\LoginRequest;
use Modules\Auth\Services\AuthService;

class AuthServiceImpl implements AuthService
{
    /**
     * Authenticate user login.
     *
     * @param LoginRequest $loginRequest
     * @return bool
     * @throws BadRequestException
     */
    public function login(LoginRequest $loginRequest): bool
    {
//        $resultCheckCaptcha = $this->_checkCaptcha($loginRequest->token, $loginRequest->action);
//
//        if (!$resultCheckCaptcha) {
//            throw new BadRequestException('Invalid Captcha');
//        }

        if (!Auth::attempt($loginRequest->toArray())) {
            throw new BadRequestException('Username or password is wrong');
        }

        return true;
    }

    /**
     * Check Captcha
     *
     * @param string $token
     * @param string $action
     * @return bool
     */
    private function _checkCaptcha(string $token, string $action): bool
    {
        $curl = curl_init();

        $headers = ['Content-type: application/x-www-form-urlencoded'];
        $data = [
            'secret' => env('recaptcha3.secretKey'),
            'response' => $token
        ];

        $url = 'https://www.google.com/recaptcha/api/siteverify';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => $headers
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        $errno = curl_errno($curl);

        curl_close($curl);

        if ($errno) {
            LogHelper::error($error, __METHOD__);

            return false;
        }

        $response = json_decode($response);

        return $response->success && $response->action === $action && $response->score >= 0.5;
    }
}
