<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaanBarang extends Model
{
    use HasFactory;

    protected $table = 'penyewaan_barang';

    protected $fillable = [
        'tanggal_sewa', 
        'tanggal_kembali', 
        'status_penyewaan', 
        'bukti_pembayaran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function transaksi_penyewaan()
    {
        return $this->hasMany(TransaksiPenyewaan::class, 'id_penyewaan');
    }
}