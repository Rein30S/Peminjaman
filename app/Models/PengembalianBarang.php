<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianBarang extends Model
{
    use HasFactory;

    protected $table = 'pengembalian_barang';
    protected $primaryKey = 'id_pengembalian';

    protected $fillable = [
        'id_penyewaan',
        'tanggal_pengembalian',
        'denda',
        'keterangan',
    ];

    // Define relationships
    public function penyewaan()
    {
        return $this->belongsTo(PenyewaanBarang::class, 'id_penyewaan');
    }
}