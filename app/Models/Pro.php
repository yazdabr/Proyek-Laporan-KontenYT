<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pro extends Model
{
    use HasFactory;

    protected $table = 'pro';
    protected $primaryKey = 'id_pro';
    public $timestamps = false;

    protected $fillable = ['nama_pro'];

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_pro', 'id_pro');
    }
}
