<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $guarded = ['id_anggota'];
    public $timestamps = false;

    public static function count(){
        $data = Anggota::all();
        return $data->count();
    }
    public static function getUserAnggota(){
        return DB::select("SELECT *, COALESCE(username,'null') AS user, anggota.id_anggota FROM anggota LEFT JOIN user ON anggota.id_anggota = user.anggota_id LEFT JOIN status_anggota ON anggota.status=status_anggota.id_status_anggota ORDER BY anggota.id_anggota ASC");
    }
}
