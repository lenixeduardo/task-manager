<?php

namespace App\Middleware;

use App\Helpers\JWTHelper;

class AuthMiddleware {
    public function __invoke($request, $response, $next) {
        $headers = $request->getHeaders();

        if (isset($headers['HTTP_AUTHORIZATION'])) {
            $jwt = str_replace('Bearer ', '', $headers['HTTP_AUTHORIZATION'][0]);


            $decoded = JWTHelper::decode($jwt);

            if ($decoded) {
        
                $request = $request->withAttribute('user', $decoded);
                return $next($request, $response);
            }
        }


        return $response->withJson(['status' => 'error', 'message' => 'Token inválido'], 401);
    }
}
