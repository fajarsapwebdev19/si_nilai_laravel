<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function account()
    {
        return view('account');
    }

    public function teacher()
    {
        return view('teacher');
    }

    public function student()
    {
        return view('student');
    }

    public function class_room()
    {
        return view('class');
    }

    public function mapel()
    {
        return view('mapel');
    }

    public function ekskul()
    {
        return view('ekskul');
    }

    public function set_profil()
    {
        return view('set_profile');
    }

    public function set_wakel()
    {
        return view('set_wakel');
    }

    public function set_mapel()
    {
        return view('set_mapel');
    }
}
