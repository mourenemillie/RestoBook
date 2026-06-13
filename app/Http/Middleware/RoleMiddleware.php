<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->role !== $role) {
            abort(403, 'Akses ditolak!');
        }

        if ($role === 'owner') {
            $restaurant = Restaurant::where('user_id', auth()->id())->first();
            if ($restaurant && $restaurant->status !== 'active') {
                if ($restaurant->is_submitted) {
                    if (!$request->routeIs('owner.pending') && !$request->routeIs('logout')) {
                        return redirect()->route('owner.pending');
                    }
                } else {
                    if ($request->routeIs('owner.pending')) {
                        return redirect()->route('owner.dashboard');
                    }
                }
            } else {
                if ($request->routeIs('owner.pending')) {
                    return redirect()->route('owner.dashboard');
                }
            }
        }

        return $next($request);
    }
}