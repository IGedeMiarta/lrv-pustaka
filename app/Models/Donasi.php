<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donasi extends Model
{
    use HasFactory;
    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';
    protected $guarded = ['id_donasi'];
    public $timestamps = false;

    public static function count(){
        $data = Donasi::all();
       return $data->count();
    }
    public static function getAllDonasi(){

        return DB::select('SELECT donasi.*,
        donatur.nama_donatur,
        donatur.no_hp,
        detail_donasi.keterangan,
        detail_donasi.status AS status_donasi,
        buku.judul 
        FROM donasi JOIN donatur ON donasi.donatur=donatur.id_donatur JOIN detail_donasi ON donasi.detail=detail_donasi.id_detail_donasi LEFT JOIN buku ON buku.kd_buku=donasi.buku ORDER BY id_donasi DESC');
    }
    public static function getAllDonasiOnTanggal($mulai,$sampai){

        return DB::select("SELECT 
                donasi.*,
                donatur.nama_donatur,
                donatur.no_hp,
                detail_donasi.keterangan,
                detail_donasi.status AS status_donasi,
                buku.judul 
            FROM 
                donasi 
            JOIN 
                donatur ON donasi.donatur=donatur.id_donatur 
            JOIN 
                detail_donasi ON donasi.detail=detail_donasi.id_detail_donasi 
            LEFT JOIN 
                buku ON buku.kd_buku=donasi.buku 
            WHERE
                donasi.tgl_donasi>= '$mulai'
            AND 
                donasi.tgl_donasi<= '$sampai'
            ORDER BY 
            id_donasi DESC");
    }
    public static function getAllDonasiWhereId($id){

        // return DB::select('SELECT donasi.*,
        // donatur.nama_donatur,
        // donatur.no_hp,
        // detail_donasi.keterangan,
        // detail_donasi.status AS status_donasi,
        // buku.judul 
        // FROM donasi JOIN donatur ON donasi.donatur=donatur.id_donatur JOIN detail_donasi ON donasi.detail=detail_donasi.id_detail_donasi LEFT JOIN buku ON buku.kd_buku=donasi.buku where id_donasi ='. $id);

        return Donasi::leftJoin('donatur','donasi.donatur','=','donatur.id_donatur')
                ->leftJoin('detail_donasi','donasi.detail','=','detail_donasi.id_detail_donasi')
                ->leftJoin('buku','buku.kd_buku','=','donasi.buku')
                ->where('id_donasi',$id)
                ->limit(1)
                ->fist();
    }
    public function donatur(){
        return $this->belongsTo(Donatur::class,'donatur');
    }
    public function detail(){
        return $this->belongsTo(DetailDonasi::class,'detail');
    }
    public function buku(){
        return $this->belongsTo(Buku::class,'buku','kd_buku');
    }
}
