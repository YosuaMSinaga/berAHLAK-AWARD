<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response {

        if (!auth()->check()) {
            return redirect()->route('login');
        }


        /*
         * Mendukung:
         * role:admin
         * role:admin,user
         * role:admin|user
         */
        $allowedRoles = [];

        foreach ($roles as $role) {

            $splitRoles = preg_split(
                '/[,|]+/',
                $role,
                -1,
                PREG_SPLIT_NO_EMPTY
            );

            $allowedRoles = array_merge(
                $allowedRoles,
                $splitRoles
            );
        }


        $userRole = auth()->user()->role;


        if (!in_array($userRole, $allowedRoles, true)) {
            abort(403, 'Anda tidak memiliki akses.');
        }


        return $next($request);
    }
}