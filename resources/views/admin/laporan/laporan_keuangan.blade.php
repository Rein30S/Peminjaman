@extends('layouts.admin.app')

@section('content')
<div class="container pt-3 pb-3">
    <h1>Laporan Keuangan</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penyewaan as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::createFromDate($item->year, $item->month, 1)->format('F') }}</td>
                    <td>{{ $item->year }}</td>
                    <td>{{ 'Rp ' . number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
