<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $datas = User::all();

        return view('admin.dashboard', compact('datas'));
    }
}
