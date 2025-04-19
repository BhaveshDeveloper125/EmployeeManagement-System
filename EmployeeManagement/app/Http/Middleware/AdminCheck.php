<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\ExtraUserData;
use App\Http\Controllers\AdminController;



class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loggedUser = Auth::user()->id;
        $isAdminorNot = ExtraUserData::where('user_id', $loggedUser)->first();

        if ($isAdminorNot && $isAdminorNot->isAdmin == 1) {
            // return response(app(AdminController::class)->hello());
            return $next($request);
        } else {
            return response()->json(["message" => "You are not Admin and you dont have a permission to access this page2..."]);
        }
    }
}
