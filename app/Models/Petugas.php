<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petugas extends Model
{
    use HasFactory;
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $guarded = ['id_petugas'];
    public $timestamps = false;
    public static function getUserPetugas(){
        return DB::select("SELECT *, COALESCE(username,'null') AS user, petugas.id_petugas FROM petugas LEFT JOIN user ON petugas.id_petugas = user.user_id ORDER BY petugas.id_petugas ASC");
    }
}
