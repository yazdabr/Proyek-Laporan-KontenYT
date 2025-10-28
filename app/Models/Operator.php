<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    protected $table = 'operator';
    protected $primaryKey = 'id_operator';
    public $timestamps = false;

    protected $fillable = ['nama_operator'];

    public function laporanA()
    {
        return $this->hasMany(Laporan::class, 'operator_a', 'id_operator');
    }

    public function laporanB()
    {
        return $this->hasMany(Laporan::class, 'operator_b', 'id_operator');
    }
}
