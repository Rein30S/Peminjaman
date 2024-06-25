<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\PenyewaanBarang;

class LaporanController extends Controller
{

    public function keuangan()
    {
        $penyewaan = DB::table('penyewaan_barang')
            ->join('transaksi_penyewaan', 'transaksi_penyewaan.id_penyewaan', '=', 'penyewaan_barang.id')
            ->join('barang', 'barang.id', '=', 'transaksi_penyewaan.id_barang')
            ->select(
                DB::raw('YEAR(penyewaan_barang.tanggal_sewa) as year'),
                DB::raw('MONTH(penyewaan_barang.tanggal_sewa) as month'),
                DB::raw('SUM(barang.harga * transaksi_penyewaan.jumlah_barang) as total_pendapatan')
            )
            ->where('penyewaan_barang.status_penyewaan', '!=', 'Menunggu konfirmasi')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return view('admin.laporan.laporan_keuangan', compact('penyewaan'));
    }

}