<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'id_pro',
        'acara',
        'topik',
        'narasumber',
        'link_youtube',
        'operator_a',
        'operator_b',
        'media',
    ];

    // Relasi ke PRO
    public function pro()
    {
        return $this->belongsTo(Pro::class, 'id_pro', 'id_pro');
    }

    // Relasi ke Operator A
    public function operatorA()
    {
        return $this->belongsTo(Operator::class, 'operator_a', 'id_operator');
    }

    // Relasi ke Operator B
    public function operatorB()
    {
        return $this->belongsTo(Operator::class, 'operator_b', 'id_operator');
    }
    public function operator()
    {
        return $this->belongsTo(Operator::class, 'id_operator');
    }

}
