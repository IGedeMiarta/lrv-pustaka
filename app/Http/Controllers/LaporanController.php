<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Donasi;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Perpanjangan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function peminjaman(){
        if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
            $mulai = $_GET['tanggal_mulai'];
            $sampai = $_GET['tanggal_sampai'];
          
            // mengambil data peminjaman berdasarkan tanggal mulai sampai tanggal sampai

            $data['peminjaman'] = Peminjaman::getAllPeminjamanOnTanggal($mulai,$sampai);
         
        } else if(isset($_GET['anggota'])){
            // mengambil data peminjaman buku dari database | dan mengurutkan data dari id peminjaman terbesar ke terkecil (desc)
            $data['peminjaman'] = Peminjaman::getAllPeminjamanOnAnggota($_GET['anggota']);
            
        }else if(isset($_GET['buku'])){
            $data['peminjaman'] = Peminjaman::getAllPeminjamanOnBuku($_GET['buku']);

        }else{
            $data['peminjaman'] = Peminjaman::getAllPeminjaman();
        }
        // dd($data);
            $data['anggota'] = Anggota::all();
            $data['book'] = Buku::all();
            $data['title'] = 'Laporan Peminjaman';
            return view('laporan.peminjaman',$data);
    }
    public function cetakpinjam(){
        if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
            $mulai = $_GET['tanggal_mulai'];
            $sampai = $_GET['tanggal_sampai'];
          
            // mengambil data peminjaman berdasarkan tanggal mulai sampai tanggal sampai

            $data['peminjaman'] = Peminjaman::getAllPeminjamanOnTanggal($mulai,$sampai);
         
        } else if(isset($_GET['anggota'])){
            // mengambil data peminjaman buku dari database | dan mengurutkan data dari id peminjaman terbesar ke terkecil (desc)
            $data['peminjaman'] = Peminjaman::getAllPeminjamanOnAnggota($_GET['anggota']);
            
        }else if(isset($_GET['buku'])){
            $data['peminjaman'] = Peminjaman::getAllPeminjamanOnBuku($_GET['buku']);

        }else{
            $data['peminjaman'] = Peminjaman::getAllPeminjaman();
        }
        $data['title']='LAPORAN PEMINJAMAN';
       return view('laporan.peminjamancetak',$data);
    }

    public function perpanjangan(){
         if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
            $mulai = $_GET['tanggal_mulai'];
            $sampai = $_GET['tanggal_sampai'];
            // mengambil data peminjaman berdasarkan tanggal mulai sampai tanggal sampai
            $data['perpanjangan'] = Perpanjangan::getAllPerpanjanganOnTanggal($mulai,$sampai);

        }else{

            $data['perpanjangan'] = Perpanjangan::getAllPerpanjangan();
        }
            $data['title'] = 'Laporan Perpanjangan';

            return view('laporan.perpanjangan',$data);
    }
    public function cetakperpanjangan(){
        if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
            $mulai = $_GET['tanggal_mulai'];
            $sampai = $_GET['tanggal_sampai'];
            // mengambil data peminjaman berdasarkan tanggal mulai sampai tanggal sampai
            $data['perpanjangan'] = Perpanjangan::getAllPerpanjanganOnTanggal($mulai,$sampai);

        }else{

            $data['perpanjangan'] = Perpanjangan::getAllPerpanjangan();
        }
        $data['title']='LAPORAN PERPANJANGAN';
        return view('laporan.perpanjangancetak',$data);
    }
    public function pengembalian(){
         if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
            $mulai = $_GET['tanggal_mulai'];
            $sampai = $_GET['tanggal_sampai'];
            // mengambil data peminjaman berdasarkan tanggal mulai sampai tanggal sampai
            $data['pengembalian'] = Pengembalian::getAllPengembalianOntanggal($mulai,$sampai);

        }else{

            $data['pengembalian'] = Pengembalian::getAllPengembalian();
        }
            $data['title'] = 'Laporan Perpanjangan';

            return view('laporan.pengembalian',$data);
    }
    public function cetakpengembalian(){
         if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
            $mulai = $_GET['tanggal_mulai'];
            $sampai = $_GET['tanggal_sampai'];
            // mengambil data peminjaman berdasarkan tanggal mulai sampai tanggal sampai
            $data['pengembalian'] = Pengembalian::getAllPengembalianOntanggal($mulai,$sampai);

        }else{

            $data['pengembalian'] = Pengembalian::getAllPengembalian();
        }
            $data['title'] = 'LAPORAN PENGEMBALIAN';

            return view('laporan.pengembaliancetak',$data);
    }
    public function donasi(){
        if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
            $mulai = $_GET['tanggal_mulai'];
            $sampai = $_GET['tanggal_sampai'];
            // mengambil data peminjaman berdasarkan tanggal mulai sampai tanggal sampai
            $data['donasi'] = Donasi::getAllDonasiOnTanggal($mulai,$sampai);

        }else{

            $data['donasi'] = Donasi::getAllDonasi();
        }
            $data['title'] = 'Laporan Donasi';

            return view('laporan.donasi',$data);
    }
    public function cetakdonasi(){
         if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
            $mulai = $_GET['tanggal_mulai'];
            $sampai = $_GET['tanggal_sampai'];
            // mengambil data peminjaman berdasarkan tanggal mulai sampai tanggal sampai
            $data['donasi'] = Donasi::getAllDonasiOnTanggal($mulai,$sampai);

        }else{

            $data['donasi'] = Donasi::getAllDonasi();
        }
            $data['title'] = 'LAPORAN DONASI';

        return view('laporan.donasicetak',$data);
    }
}