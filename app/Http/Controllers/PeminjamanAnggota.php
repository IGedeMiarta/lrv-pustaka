<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanAnggota extends Controller
{
    public function peminjaman(){
        $id = auth()->user()->anggota_id;
        $data['title'] = 'Peminjaman Aktif';
        $data['peminjaman'] = Peminjaman::getAllPeminjamaActiveAnggota($id);
        return view('anggota.peminjamanaktif',$data);
    }
    public function history(){
        $id = auth()->user()->anggota_id;
        $data['title'] = 'Peminjaman Aktif';
        $data['peminjaman'] = Peminjaman::getAllPeminjamaActiveAnggota($id);
        return view('anggota.peminjamanhistory',$data);
    }
    
}
