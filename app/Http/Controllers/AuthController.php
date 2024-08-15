<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\ProfilSekolah;

class AuthController extends Controller
{
    public function auth()
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role_id;

            // Redirect berdasarkan role
            switch ($userRole) {
                case 1:
                    return redirect('/admin/');
                case 2:
                    return redirect('guru/');
                case 3:
                    return redirect('siswa/');
                default:
                    return view('/'); // Halaman default jika role tidak cocok
            }
        }

        $ps = ProfilSekolah::first();
        return view('auth', compact('ps'));
    }

    public function auth_process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username Harus Di Isi',
            'password.required' => 'Password Harus Di Isi'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();

            return response()->json(['message' => $errors], 400);
        }

        $user = User::where('username', $request->username)->first();

        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                Auth::login($user);

                if($user->status == "n")
                {
                    Auth::logout();
                    return response()->json(['message' => 'Gagal Login. Akun Anda Tidak Aktif'], 400);
                }

                $role = $user->role_id;

                return response()->json(['message' => 'Berhasil Login', 'role' => $role], 200);
            }else{
                return response()->json(['message' => 'Password Salah'], 400);
            }
        }else{
            return response()->json(['message' => 'Username Salah'], 400);
        }
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['status' => 'ok'], 200);
    }
}
