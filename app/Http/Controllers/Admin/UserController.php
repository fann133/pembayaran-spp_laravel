<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->get();

        $users = $users->map(function ($user) {
            $user->is_online   = Cache::has("user-is-online-{$user->id_users}");
            $user->online_ip   = Cache::get("user-ip-{$user->id_users}", $user->last_ip);
            $user->user_agent  = Cache::get("user-agent-{$user->id_users}", $user->user_agent);

            // Last seen text
            $user->last_seen_text = $user->last_seen
                ? Carbon::parse($user->last_seen)->diffForHumans()
                : ' - ';

            // Device info
            if (!empty($user->user_agent)) {
                $agent = new Agent();
                $agent->setUserAgent($user->user_agent);

                if ($agent->isMobile() || $agent->isTablet()) {
                    $user->device_info = $agent->device() . ' - ' . $agent->browser();
                } else {
                    $user->device_info = $agent->platform() . ' - ' . $agent->browser();
                }
            } else {
                $user->device_info = ' - ';
            }

            return $user;
        });

        // Urutkan: online dulu
        $users = $users->sort(function ($a, $b) {
            if ($a->is_online && !$b->is_online) return -1;
            if (!$a->is_online && $b->is_online) return 1;
            return $b->created_at <=> $a->created_at;
        });

        return view('admin.user.index', compact('users'));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Ambil daftar role unik dari tabel users
        $roles = DB::table('users')->select('role_id')->distinct()->get();

        return view('admin.user.edit', compact('user', 'roles'));
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

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui!');
    }
}
