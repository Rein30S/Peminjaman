<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('admin.barang.stok_barang', compact('barang'));
    }

    public function create()
    {
        return view('admin.barang.tambah_barang');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $barang = new Barang();
        $barang->nama_barang = $validatedData['nama_barang'];
        $barang->stok = $validatedData['stok'];
        $barang->harga = $validatedData['harga'];
        
        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('storage/images'), $imageName);
            $barang->gambar = 'storage/images/'.$imageName;
        }

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.edit_barang', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->stok = $request->stok;
        $barang->harga = $request->harga;

        if ($request->hasFile('gambar')) {
            $filePath = public_path('storage/images');
            $file = $request->file('gambar');
            $file_name = time() . '_' . $file->getClientOriginalName();
            
            $file->move($filePath, $file_name);

            if (!is_null($barang->gambar)) {
                $oldImage = public_path($barang->gambar);
                if (File::exists($oldImage)) {
                    if (!unlink($oldImage)) {

                    }
                }
            }

            $barang->gambar = 'storage/images/' . $file_name;
        }

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        if (!is_null($barang->gambar)) {
            $oldImage = public_path($barang->gambar);
            if (File::exists($oldImage)) {
                if (!unlink($oldImage)) {

                }
            }
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
