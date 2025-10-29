<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $kelas = Kelas::whereHas('bergabung', function($query) {
                $query->where('id_user', Auth::id());
            })
            ->with('user')
            ->latest()
            ->take(4)
            ->get();

        return view('user.dashboard', compact('kelas'));
    }
}