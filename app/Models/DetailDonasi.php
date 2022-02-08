<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDonasi extends Model
{
    use HasFactory;
    protected $table = 'detail_donasi';
    protected $primaryKey = 'id_detail_donasi';
    protected $guarded = ['id_detail_donasi'];
    public $timestamps = false;

    public function donasi(){
        return $this->hasOne(Donasi::class);
    }
    
}
