<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;
    protected $table = 'detail_peminjaman';
    protected $primaryKey = 'id_detail_peminjaman';
    protected $guarded = ['id_detail_peminjaman'];
    public $timestamps = false;
}
