<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('profil.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Pastikan user hanya bisa edit profilnya sendiri
        if ($id != Auth::id()) {
            abort(403);
        }
        
        $user = Auth::user();
        return view('profil.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    if ($id != Auth::id()) {
        abort(403);
    }

    $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $id . ',id_user',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id . ',id_user',
        'password' => 'nullable|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = User::findOrFail($id);
    $user->username = $request->input('username');
    $user->email = $request->input('email');
    
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }
    
    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        // Delete old profile picture if exists
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }
        
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
    }
    
    $user->save();

    return redirect()->route('profil.index')->with('success', 'Profil berhasil diupdate');
}
}