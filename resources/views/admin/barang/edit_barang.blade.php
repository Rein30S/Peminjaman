@extends('layouts.admin.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container pt-3">
    <h1>Edit Barang</h1>
    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}">
        </div>
        <div class="form-group">
            <label for="stok">Jumlah:</label>
            <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}">
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="text" name="harga" class="form-control" value="{{ $barang->harga }}">
        </div>
        <div class="form-group">
            <label for="gambar">Gambar:</label>
            <input type="file" name="gambar" class="form-control-file">
            @if($barang->gambar)
                <img src="{{ asset($barang->gambar) }}" alt="{{ $barang->nama_barang }}" width="300" class="mt-3">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection