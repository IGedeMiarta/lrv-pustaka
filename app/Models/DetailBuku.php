<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailBuku extends Model
{
    use HasFactory;
    protected $table = 'detail_buku';
    protected $primaryKey = 'id_detail';
    protected $guarded = ['id_detail'];
    public $timestamps = false;

    public function buku(){
        return $this->belongsTo(Buku::class,'kd_buku','kd_buku');
    }
    public static function getAllDetail($id){
        return DB::select('SELECT *,detail_buku.status as status_buku FROM buku JOIN detail_buku JOIN rak ON buku.kd_buku=detail_buku.kd_buku AND detail_buku.rak=rak.id_rak WHERE detail_buku.kd_buku=? ORDER BY detail_buku.kd_detail', [$id]);
    }
}
