<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenyewaanBarang;
use App\Models\TransaksiPenyewaan;
use App\Models\User;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenyewaanMemberController extends Controller
{

    public function index()
    {
        $userId = auth()->id();
        $penyewaan = TransaksiPenyewaan::with(['user', 'barang', 'penyewaan'])
            ->where('id_user', $userId)
            ->get()
            ->groupBy('penyewaan.id');

        return view('user.penyewaan.penyewaan', compact('penyewaan'));
    }


    public function create()
    {
        $user = Auth::user();
        $barang = Barang::all();
        return view('user.penyewaan.tambah_penyewaan', compact('user', 'barang'));
    }

    public function riwayat()
    {
        $userId = auth()->id();
        $penyewaan = TransaksiPenyewaan::with(['user', 'barang', 'penyewaan'])
            ->where('id_user', $userId)
            ->get()
            ->groupBy('penyewaan.id');

        return view('user.penyewaan.riwayat_penyewaan', compact('penyewaan'));
    }

    public function getBarang($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json($barang);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
            'id_user' => 'required|exists:users,id',
            'barang' => 'required|array|min:1|max:5',
            'barang.*.id_barang' => 'required|exists:barang,id',
            'barang.*.jumlah' => 'required|integer|min:1',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::transaction(function() use ($request) {
            $imageName = time().'.'.$request->bukti_pembayaran->extension();  
            $request->bukti_pembayaran->move(public_path('storage/bukti_pembayaran'), $imageName);
            $buktiPembayaran = 'bukti_pembayaran/'.$imageName;

            $totalHarga = 0;

            $penyewaan = PenyewaanBarang::create([
                'id_user' => $request->id_user,
                'tanggal_sewa' => $request->tanggal_sewa,
                'tanggal_kembali' => $request->tanggal_kembali,
                'total_harga' => $totalHarga,
                'status_penyewaan' => 'Menunggu Konfirmasi', // Menetapkan status menjadi "Menunggu Konfirmasi"
                'bukti_pembayaran' => $buktiPembayaran,
            ]);

            foreach ($request->barang as $barang) {
                $itemBarang = Barang::find($barang['id_barang']);
                if ($itemBarang->stok < $barang['jumlah']) {
                    throw new \Exception('Stok barang tidak mencukupi.');
                }
                $totalHarga += $itemBarang->harga * $barang['jumlah'];
                $itemBarang->stok -= $barang['jumlah'];
                $itemBarang->save();

                TransaksiPenyewaan::create([
                    'id_penyewaan' => $penyewaan->id,
                    'id_user' => $request->id_user,
                    'id_barang' => $barang['id_barang'],
                    'jumlah_barang' => $barang['jumlah'],
                ]);
            }

            $penyewaan->update(['total_harga' => $totalHarga]);
        });

        return redirect()->route('penyewaan_member.index')->with('success', 'Penyewaan berhasil ditambahkan.');
    }

}