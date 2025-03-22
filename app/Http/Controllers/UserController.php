<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Fungsi untuk menangani login
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user(); // Ambil data user
        
            $user->update(['login_times' => now()]);
        
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    // Fungsi logout
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect()->route('login'); // Redirect ke halaman login
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();
        return view('user.index', compact('users'));
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Ambil daftar role unik dari tabel users
        $roles = DB::table('users')->select('role_id')->distinct()->get();

        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id . ',id_users',
            'password' => 'nullable|min:5',
            'role_id' => 'required|in:1,2,3,4,5', // Pastikan role_id valid
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->role_id = $request->role_id;

        if ($request->password) { 
            $user->password = Hash::make($request->password);
            $user->bypass = $request->password; // Simpan password asli di bypass
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }
}
