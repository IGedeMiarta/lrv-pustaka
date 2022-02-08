<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'isbn';
    protected $guarded = ['isbn'];
    public $timestamps = false;

    public function Pengarang(){
        return $this->belongsTo(Pengarang::class,'pengarang','kd_pengarang');
    }
    public function Penerbit(){
        return $this->belongsTo(Penerbit::class,'penerbit','kd_penerbit');
    }

    public static function count(){
        $data = Buku::all();
        return $data->count();
    }

    public static function getAllAvailableBook(){
        $data = Buku::leftJoin('detail_buku','buku.kd_buku','=','detail_buku.kd_buku')
                    ->leftJoin('rak','detail_buku.rak','=','rak.id_rak')
                    ->where('detail_buku.status',1)
                    ->groupBy('detail_buku.kd_buku')
                    ->get();
        return $data;
    }
    public function donasi(){
        return $this->hasOne(Donasi::class,'kd_buku','kd_buku');
    }
    public function detail_buku(){
        return $this->hasOne(DetailBuku::class,'kd_buku');
    }
    public static function getAllBook(){
        $data = Buku::leftJoin('pengarang','buku.pengarang','=','pengarang.kd_pengarang')
                    ->leftJoin('penerbit','buku.penerbit','=','penerbit.kd_penerbit')
                    ->leftJoin('kategori','buku.kategori','=','kategori.kd_kategori')
                    ->select('buku.isbn',
                        'buku.kd_buku',
                        'buku.judul',
                        'pengarang.nama_pengarang',
                        'penerbit.nama_penerbit',
                        'buku.th_terbit',
                        'kategori.nama_kategori',
                        'buku.status')
                    ->orderByDesc('isbn')
                    ->get();
        return $data;
    }
}
