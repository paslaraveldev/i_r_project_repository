<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckGroupMembership
{
     public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $group = $user->groups()->first();

        if (!$group) {
            return redirect()->route('concepts.index')
                ->with('error', 'You are not assigned to any group.');
        }

        return $next($request);
    }
}
