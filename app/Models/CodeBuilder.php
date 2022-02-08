<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeBuilder extends Model
{
    use HasFactory;
    public static function kd_buku(){
        $buku =  Buku::all();
        $kode = $buku->count();
        $no = $kode + 1;
        return 'BK' . sprintf("%04s", $no);
    }
    public static function kd_pengarang(){
        $buku =  Pengarang::all();
        $kode = $buku->count();
        $no =  $kode + 1;
        return 'PG' . sprintf("%04s", $no);
    }
    public static function kd_penerbit(){
        $buku =  Penerbit::all();
        $kode = $buku->count();
        $no =  $kode + 1;
        return 'PN' . sprintf("%04s", $no);
    }
    public static function kd_kategori(){
        $buku =  Kategori::all();
        $kode = $buku->count();
        $no =  $kode + 1;
        return 'KT' . sprintf("%04s", $no);
    }
    public static function kd_detail($id){
        $detail_buku = Buku::leftJoin('detail_buku','buku.kd_buku','=','detail_buku.kd_buku')
                            ->selectRaw('buku.isbn,buku.kd_buku,MAX(detail_buku.kd_detail) AS detail_buku')
                            ->where('buku.isbn',$id)
                            ->first();
        $dariDB = $detail_buku['detail_buku'];
        $nourut = substr($dariDB, 9, 1);
        $id_detail = substr($dariDB, 0, 9);
        $_nourut = intval($nourut);
        $kdBukuNow = $_nourut + 1;
        $id_buku = $detail_buku['kd_buku'];
        if ($id_detail == '') {
            $_idDetail = $id_buku . "DTL1";
        } else {
            $_idDetail = $id_buku . "DTL" . $kdBukuNow;
        }
        return $_idDetail;
    }
}
