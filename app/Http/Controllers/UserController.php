<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('user.dashboard');
    }

    public function getProfile($id) {
        return view('user.profile')->with('id', $id);
    }
}
