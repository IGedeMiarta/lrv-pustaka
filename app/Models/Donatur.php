<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;
    protected $table = 'donatur';
    protected $primaryKey = 'id_donatur';
    protected $guarded = ['id_donatur'];
    public $timestamps = false;

    public function donasi(){
       return $this->hasMany(Donasi::class);
    }
}
