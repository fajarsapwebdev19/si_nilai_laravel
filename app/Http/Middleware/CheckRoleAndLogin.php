<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CheckRoleAndLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Periksa jika pengguna telah login
        if (Auth::check()) {
            if (!empty($roles) && !in_array(Auth::user()->role_id, $roles)) {
                // If user role is not allowed, redirect or return an appropriate response
                abort(403);
            }

            $user = Auth::user();

            // Fetch user data from database
            $userData = DB::table('users')
                ->join('personal_data', 'users.personal_id', '=', 'personal_data.id')
                ->join('role', 'users.role_id', '=', 'role.id')
                ->select('users.*', 'users.id as user_id', 'personal_data.*', 'personal_data.id as personal_id', 'role.name as role_name', 'role.id as role_id')
                ->where('users.id', $user->id)
                ->first();

            if($user->role_id == 2)
            {
                $dataGuru = DB::table('guru')
                ->select('*')
                ->where('user_id', $user->id)
                ->first();

                Session::put('dataGuru', $dataGuru);
                View::share('dataGuru', $dataGuru);
            }

            // Store user data in session
            Session::put('userData', $userData);

            // Share user data with all views
            View::share('userData', $userData);


            // Jika pengguna telah login dan tidak mencoba mengakses halaman login, lanjutkan permintaan
            return $next($request);
        }

        // Jika pengguna belum login, arahkan ke halaman login
        return redirect('/?message=Belum Login');
    }
}
