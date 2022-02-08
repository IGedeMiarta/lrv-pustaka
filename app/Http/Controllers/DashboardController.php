<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Donasi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        if (auth()->user()->role == 'Petugas') {
            $text = 'Halaman Petugas perpustakaan, Petugas Perpus dapat menambah data buku perpustakaan dengan menginputkan data buku, dan mengontrol seluruh aktifitas peminjaman dan pengembalian buku.';
        }elseif(auth()->user()->role == 'Admin'){
            $text = 'Halaman Kepala perpustakaan, Kepala Perpus dapat menambah petugas perpustakaan dengan menginputkan data petugas, dan mengontrol seluruh aktifitas sistem</b>.';
        }else{
            $text = 'Halaman Anggota perpustakaan, Anggota Perpus dapat melihat data buku perpustakaan.</b>.';
        }
        $data['title'] = 'Dashboard';
        $data['anggota'] = Anggota::count();
        $data['buku'] = Buku::count();
        $data['peminjaman'] = Peminjaman::countActive();
        $data['donasi'] = Donasi::count();
        $data['text'] = $text;
        return view('dashboard.dashboard',$data);
    }
}
