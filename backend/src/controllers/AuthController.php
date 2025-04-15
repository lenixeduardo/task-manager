<?php

namespace App\Controllers;

use App\Helpers\JWTHelper;
use App\Models\User;

class AuthController {

    public function login($data) {

        $user = User::findByUsername($data['username']); 

        if ($user && password_verify($data['password'], $user->password)) {

            $jwt = JWTHelper::encode(['username' => $user->username, 'id' => $user->id]);

            return ['status' => 'success', 'token' => $jwt];
        }

        return ['status' => 'error', 'message' => 'Credenciais inválidas'];
    }
}
