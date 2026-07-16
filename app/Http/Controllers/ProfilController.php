<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfilController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        return view('profil.index', compact('user'));
    }

    public function edit(int $id): View
    {
        if ($id !== (int) Auth::id()) {
            abort(403);
        }
        
        $user = Auth::user();
        return view('profil.edit', compact('user'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        if ($id !== (int) Auth::id()) {
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
        
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && $user->profile_picture !== 'default.jpg' && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
        
        $user->save();

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diupdate');
    }
}