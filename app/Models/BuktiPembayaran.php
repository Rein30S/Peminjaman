<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    use HasFactory;

    protected $table = 'bukti_pembayaran';

    protected $fillable = ['penyewaan_id', 'nama_file'];

    public function penyewaan()
    {
        return $this->belongsTo(PenyewaanBarang::class, 'penyewaan_id');
    }
}