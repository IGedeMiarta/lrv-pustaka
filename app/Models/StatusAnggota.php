<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAnggota extends Model
{
    use HasFactory;
    protected $table = 'status_anggota';
    protected $primaryKey = 'id_status_anggota';
    protected $guarded = ['id_status_anggota'];
    public $timestamps = false;
}
