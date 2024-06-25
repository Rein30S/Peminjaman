<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenyewaan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penyewaan';

    protected $fillable = [
        'id_penyewaan', 
         'id_user', 
         'id_barang', 
         'jumlah_barang'
    ];

    public function penyewaan()
    {
        return $this->belongsTo(PenyewaanBarang::class, 'id_penyewaan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
