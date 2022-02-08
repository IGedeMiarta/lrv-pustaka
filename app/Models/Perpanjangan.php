<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perpanjangan extends Model
{
    use HasFactory;
    protected $table = 'perpanjangan';
    protected $primaryKey = 'id_perpanjangan';
    protected $guarded = ['id_perpanjangan'];
    public $timestamps = false;

    public static function getAllPerpanjangan(){
          return  Peminjaman::leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                        ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                        ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                        ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                        ->where('peminjaman.detail',4)
                        ->orderByDesc('peminjaman.id_peminjaman')
                        ->get();
    }
    public static function getAllPerpanjanganOnTanggal($mulai,$sampai){
          return  Perpanjangan::leftJoin('peminjaman','peminjaman.id_peminjaman','=','perpanjangan.id_peminjaman')
                        ->leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                        ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                        ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                        ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                        ->where('peminjaman.detail',4)
                        ->where('tgl_perpanjangan','>=',$mulai)
                        ->where('tgl_perpanjangan','<=',$sampai)
                        ->orderByDesc('peminjaman.id_peminjaman')
                        ->get();
    }
}
