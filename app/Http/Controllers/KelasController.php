<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Bergabung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $search = request('search');
    
    // Query untuk kelas yang diikuti user dengan fitur search
    $kelas = Kelas::whereHas('anggota', function($query) {
        $query->where('id_user', Auth::user()->id_user);
    })
    ->when($search, function($query, $search) {
        $query->where(function($q) use ($search) {
            $q->where('nama_kelas', 'like', '%'.$search.'%')
              ->orWhere('deskripsi_kelas', 'like', '%'.$search.'%')
              ->orWhereHas('user', function($userQuery) use ($search) {
                  $userQuery->where('username', 'like', '%'.$search.'%');
              });
        });
    })
    ->with('user')
    ->paginate(5); // 5 item per halaman
    
    return view('user.kelas.index', compact('kelas'));
}

    /**
     * Store a newly created resource in storage - untuk bergabung kelas
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kelas' => 'required|string|exists:kelas,kode_kelas',
        ]);

        // Cari kelas berdasarkan kode
        $kelas = Kelas::where('kode_kelas', $request->kode_kelas)->first();

        // Cek apakah user sudah bergabung
        $sudahBergabung = Bergabung::where('id_user', Auth::user()->id_user)
                                  ->where('id_kelas', $kelas->id_kelas)
                                  ->exists();

        if ($sudahBergabung) {
            return redirect()->back()
                           ->with('error', 'Anda sudah bergabung dengan kelas ini.');
        }

        // Bergabung ke kelas
        Bergabung::create([
            'id_user' => Auth::user()->id_user,
            'id_kelas' => $kelas->id_kelas,
        ]);

        return redirect()->route('kelas.index')
                        ->with('success', 'Berhasil bergabung ke kelas!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kelas = Kelas::with(['user', 'anggota'])->findOrFail($id);
        
        // Cek apakah user sudah bergabung dengan kelas ini
        $isMember = Bergabung::where('id_user', Auth::user()->id_user)
                           ->where('id_kelas', $id)
                           ->exists();

        if (!$isMember) {
            abort(403, 'Anda tidak memiliki akses ke kelas ini.');
        }

        return view('user.kelas.show', compact('kelas'));
    }
}