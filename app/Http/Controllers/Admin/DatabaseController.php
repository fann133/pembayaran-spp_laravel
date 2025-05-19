<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Models\Setting;

class DatabaseController extends Controller
{
    public function index()
    {
        // Ambil daftar tabel dari database
        $tables = DB::select('SHOW TABLES');
        $dbName = env('DB_DATABASE');
        $tableKey = "Tables_in_{$dbName}";
        $pengaturan = Setting::first();
        return view('admin.database', compact('tables', 'tableKey', 'pengaturan'));
    }

    public function download()
    {
        $fileName = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';
        $filePath = storage_path('app/' . $fileName);

        $dbHost = env('DB_HOST', '127.0.0.1');
        $dbName = env('DB_DATABASE', 'spp');
        $dbUser = env('DB_USERNAME', 'root');
        $dbPass = env('DB_PASSWORD', '');

        // Path mysqldump untuk Windows
        $mysqldumpPath = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';
        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $mysqldumpPath = 'mysqldump'; // Gunakan langsung untuk Linux/macOS
        }

        // Perbaiki format command untuk password kosong
        $passwordPart = $dbPass ? "--password={$dbPass}" : "";

        $command = "\"{$mysqldumpPath}\" --user={$dbUser} {$passwordPart} --host={$dbHost} {$dbName} > \"{$filePath}\"";

        $output = null;
        $resultCode = null;
        exec($command, $output, $resultCode);

        if ($resultCode !== 0 || !file_exists($filePath)) {
            return back()->with('error', 'Gagal membuat backup database. Pastikan mysqldump tersedia dan database bisa diakses.');
        }

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function backup(Request $request)
    {
        $fileName = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';
        $filePath = storage_path('app/' . $fileName);

        $dbHost = env('DB_HOST', '127.0.0.1');
        $dbName = env('DB_DATABASE', 'spp');
        $dbUser = env('DB_USERNAME', 'root');
        $dbPass = env('DB_PASSWORD', '');

        $mysqldumpPath = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';
        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $mysqldumpPath = 'mysqldump';
        }

        $passwordPart = $dbPass ? "--password={$dbPass}" : "";
        $selectedTable = $request->input('table');

        // Jika user memilih tabel tertentu, backup hanya tabel tersebut
        if ($selectedTable) {
            $command = "\"{$mysqldumpPath}\" --user={$dbUser} {$passwordPart} --host={$dbHost} {$dbName} {$selectedTable} > \"{$filePath}\"";
        } else {
            // Backup seluruh database
            $command = "\"{$mysqldumpPath}\" --user={$dbUser} {$passwordPart} --host={$dbHost} {$dbName} > \"{$filePath}\"";
        }

        exec($command, $output, $resultCode);

        if ($resultCode !== 0 || !file_exists($filePath)) {
            return back()->with('error', 'Gagal membuat backup database.');
        }

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
