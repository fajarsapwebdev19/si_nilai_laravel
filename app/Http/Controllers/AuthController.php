<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah;

class AuthController extends Controller
{
    public function auth(){
        $ps = ProfilSekolah::first();
        return view('auth', compact('ps'));
    }
}
