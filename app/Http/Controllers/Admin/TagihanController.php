<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::with(['siswa', 'biaya'])->get();
        return view('admin.tagihan.index', compact('tagihan'));
    }
}

