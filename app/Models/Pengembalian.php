<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    protected $guarded = ['id_pengembalian'];
    public $timestamps = false;

    public static function getAllPengembalian(){
        return Pengembalian::leftJoin('detail_pengembalian','pengembalian.detail','=','detail_pengembalian.id_detail_pengembalian')
                            ->leftJoin('peminjaman','pengembalian.id_pinjam','=','peminjaman.id_peminjaman')
                            ->leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                            ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                            ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                            ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                            ->orderByDesc('peminjaman.id_peminjaman')
                            ->get();
    }
     public static function getAllPengembalianOntanggal($mulai,$sampai){
        return Pengembalian::leftJoin('detail_pengembalian','pengembalian.detail','=','detail_pengembalian.id_detail_pengembalian')
                            ->leftJoin('peminjaman','pengembalian.id_pinjam','=','peminjaman.id_peminjaman')
                            ->leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                            ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                            ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                            ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                            ->where('tgl_kembali','>=',$mulai)
                            ->where('tgl_kembali','<=',$sampai)
                            ->orderByDesc('peminjaman.id_peminjaman')
                            ->get();
    }
}
