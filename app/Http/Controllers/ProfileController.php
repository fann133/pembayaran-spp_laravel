<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function upload(Request $request)
    {
        $user = auth()->user();

        if (!$request->hasFile('avatar')) {
            return back()->with('error', 'Tidak ada file yang diunggah.');
        }

        $file = $request->file('avatar');

        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, $allowedExtensions)) {
            return back()->with('error', 'Format gambar tidak sesuai. Hanya diperbolehkan jpg, jpeg, atau png.');
        }

        if ($file->getSize() > 2048 * 1024) {
            return back()->with('error', 'Ukuran gambar melebihi batas maksimal 2MB.');
        }

        list($width, $height) = getimagesize($file);
        if ($width < 100 || $height < 100) {
            return back()->with('error', 'Gambar terlalu kecil. Harap unggah gambar dengan resolusi yang lebih baik.');
        }

        $name = strtolower(str_replace(' ', '-', $user->name));
        $username = strtolower($user->username);
        $filename = $name . '_' . $username . '-' . time() . '.' . $extension;

        $destination = public_path('assets/img/profil');

        if ($user->gambar && file_exists($destination . '/' . $user->gambar)) {
            unlink($destination . '/' . $user->gambar);
        }

        $file->move($destination, $filename);
        $user->gambar = $filename;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    public function deleteImage(Request $request)
    {
        $user = auth()->user();
        $gambarPath = public_path('assets/img/profil/' . $user->gambar);

        Log::info('Path gambar yang akan dihapus: ' . $gambarPath);

        if ($user->gambar && file_exists($gambarPath)) {
            if (unlink($gambarPath)) {
                $user->gambar = null;
                $user->save();

                Log::info('Gambar berhasil dihapus: ' . $gambarPath);

                return back()->with('success', 'Foto profil berhasil dihapus.');
            } else {
                Log::error('Gagal menghapus gambar: ' . $gambarPath);
                return back()->with('error', 'Gambar gagal dihapus.');
            }
        } else {
            Log::warning('Gambar tidak ditemukan untuk dihapus: ' . $gambarPath);
            return back()->with('error', 'Gambar tidak ditemukan.');
        }
    }

}
