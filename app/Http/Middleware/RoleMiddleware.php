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

        // Menggabungkan dan memecah role jika menggunakan pemisah koma (,) atau pipa (|)
        $allowedRoles = [];
        foreach ($roles as $role) {
            $allowedRoles = array_merge($allowedRoles, preg_split('/[,|]/', $role));
        }

        if (!in_array(auth()->user()->role, $allowedRoles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}