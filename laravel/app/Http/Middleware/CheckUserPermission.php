<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserPermission
{
    public function handle($request, Closure $next, $permission)
    {
        /** @var \App\Models\AuthModel|null $user */
        $user = Auth::user();

        if (!$user || !$user->hasPermission($permission)) {
            throw new \App\Exceptions\HasNoPermissionException();
        }

        return $next($request);
    }
}