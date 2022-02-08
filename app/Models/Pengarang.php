<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    use HasFactory;
    protected $table = 'pengarang';
    protected $primaryKey = 'id_pengarang';
    protected $guarded = ['id_pengarang'];
    public $timestamps = false;

    public function buku(){
        return $this->hasMany(Buku::class,'kd_pengarang','kd_pengarang');
    }
}
