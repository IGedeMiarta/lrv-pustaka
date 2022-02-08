<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $guarded = ['id_peminjaman'];
    public $timestamps = false;

    public static function countActive(){
        $data = Peminjaman::where('detail',1)->orWhere('detail',4)->get();
        return $data->count();
    }
    public static function makeCode(){
        $qry =  DB::table('peminjaman')->groupBy('id_anggota')->get();
        $row = $qry->count();
        $code = $row + 1;
        return date('dmy').'/'.$code;
    }
    public static function getAllPeminjamanOnTanggal($mulai,$sampai){
        return  Peminjaman::leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                        ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                        ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                        ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                        ->where('tgl_pinjam','>=',$mulai)
                        ->where('tgl_pinjam','<=',$sampai)
                        ->orderByDesc('peminjaman.id_peminjaman')
                        ->get();
    }
    public static function getAllPeminjamanOnAnggota($id){
        return Peminjaman::leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                        ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                        ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                        ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                        ->where('peminjaman.id_anggota',$id)
                        ->orderByDesc('peminjaman.id_peminjaman')
                        ->get();
    }
    public static function getAllPeminjamanOnBuku($id){
        return Peminjaman::leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                        ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                        ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                        ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                        ->where('peminjaman.isbn',$id)
                        ->orderByDesc('peminjaman.id_peminjaman')
                        ->get();
    }
     public static function getAllPeminjamanAnggota($id){
        return  Peminjaman::leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                        ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                        ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                        ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                        ->where('peminjaman.id_anggota',$id)
                        ->orderByDesc('peminjaman.id_peminjaman')
                        ->get();
    }
    public static function getAllPeminjaman(){
        return  Peminjaman::leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                        ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                        ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                        ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                        ->orderByDesc('peminjaman.id_peminjaman')
                        ->get();
    }
    public static function getAllPeminjamaActive(){
        return  Peminjaman::leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                        ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                        ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                        ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                        ->whereRaw('peminjaman.detail=1 OR peminjaman.detail=4')
                        ->orderByDesc('peminjaman.id_peminjaman')
                        ->get();
    }
     public static function getAllPeminjamaActiveAnggota($anggota){
        return  Peminjaman::leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                        ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                        ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                        ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                        // ->where('peminjaman.id_anggota',$anggota)
                        ->whereRaw('peminjaman.id_anggota = ? AND (peminjaman.detail=1 OR peminjaman.detail=4)',[$anggota])
                        ->orderByDesc('peminjaman.id_peminjaman')
                        ->get();
    }
    public static function countPeminjamanAnggota($anggota){
        $data = Peminjaman::where('id_anggota',$anggota)
                        ->whereRaw('peminjaman.detail=1 OR peminjaman.detail=4')
                        ->get();
        return $data->count();
    }
    public static function getAllPeminjamanTerpinjam(){
         return  Peminjaman::leftJoin('anggota','peminjaman.id_anggota','=','anggota.id_anggota')
                        ->leftJoin('detail_peminjaman','peminjaman.detail','=','detail_peminjaman.id_detail_peminjaman')
                        ->leftJoin('detail_buku','peminjaman.isbn','=','detail_buku.id_detail')
                        ->leftJoin('buku','detail_buku.kd_buku','=','buku.kd_buku')
                        ->where('peminjaman.detail',1)
                        ->orderByDesc('peminjaman.id_peminjaman')
                        ->get();
    }
}
