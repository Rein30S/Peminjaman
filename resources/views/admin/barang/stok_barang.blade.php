@extends('layouts.admin.app')

@section('title', 'Stok Barang')

@section('content')
<div class="container mt-3">
    <h1>Stok Barang</h1>
    <a href="{{ route('barang.create') }}" class="btn btn-success mb-3">Tambah Barang</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ 'Rp '.$item->harga }}</td>
                <td>
                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_barang }}" width="50">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td>
                    <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('barang.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection