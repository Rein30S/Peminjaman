@extends('layouts.user.app')

@section('content')
<div class="container pt-3 pb-3">
    <h1>Daftar Penyewaan Barang</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Kembali</th>
                <th>Total Harga</th>
                <th>Status Penyewaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penyewaan as $penyewaanGroup)
                @php
                    $firstPenyewaan = $penyewaanGroup->first();
                    $totalHarga = $penyewaanGroup->sum(function($transaksi) {
                        return $transaksi->barang ? $transaksi->barang->harga * $transaksi->jumlah_barang : 0;
                    });
                    $barangList = $penyewaanGroup->map(function($transaksi) {
                        return $transaksi->barang->nama_barang . ' (' . $transaksi->jumlah_barang . ')';
                    })->toArray();
                @endphp
                @if($firstPenyewaan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $firstPenyewaan->penyewaan->tanggal_sewa }}</td>
                    <td>{{ $firstPenyewaan->penyewaan->tanggal_kembali }}</td>
                    <td>{{ 'Rp ' . number_format($totalHarga, 0, ',', '.') }}</td>
                    <td>{{ $firstPenyewaan->penyewaan->status_penyewaan }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal"
                                data-nama="{{ $firstPenyewaan->user->nama_lengkap }}"
                                data-barang="{{ implode(', ', $barangList) }}"
                                data-totalharga="Rp {{ number_format($totalHarga, 0, ',', '.') }}"
                                data-tanggalsewa="{{ $firstPenyewaan->penyewaan->tanggal_sewa }}"
                                data-tanggalkembali="{{ $firstPenyewaan->penyewaan->tanggal_kembali }}"
                                data-totalbiaya="Rp {{ number_format($totalHarga, 0, ',', '.') }}"
                                data-bukti="{{ asset('storage/' . $firstPenyewaan->penyewaan->bukti_pembayaran) }}">
                            Detail
                        </button>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Detail Penyewaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><strong>Nama Peminjam:</strong> <span id="modalNamaPeminjam"></span></p>
          <p><strong>Barang yang Dipinjam:</strong> <span id="modalBarangDipinjam"></span></p>
          <p><strong>Total Harga Peminjaman:</strong> <span id="modalTotalHarga"></span></p>
          <p><strong>Tanggal Sewa:</strong> <span id="modalTanggalSewa"></span></p>
          <p><strong>Tanggal Kembali:</strong> <span id="modalTanggalKembali"></span></p>
          <p><strong>Total Biaya:</strong> <span id="modalTotalBiaya"></span></p>
          <p><strong>Bukti Pembayaran:</strong></p>
          <img id="modalBuktiPembayaran" src="" alt="Bukti Pembayaran" style="width: 100%;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  
  @push('scripts')
  <script>
      $('#detailModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); 
          var nama = button.data('nama');
          var barang = button.data('barang');
          var totalHarga = button.data('totalharga');
          var tanggalSewa = button.data('tanggalsewa');
          var tanggalKembali = button.data('tanggalkembali');
          var totalBiaya = button.data('totalbiaya');
          var bukti = button.data('bukti');
  
          var modal = $(this);
          modal.find('#modalNamaPeminjam').text(nama);
          modal.find('#modalBarangDipinjam').text(barang);
          modal.find('#modalTotalHarga').text(totalHarga);
          modal.find('#modalTanggalSewa').text(tanggalSewa);
          modal.find('#modalTanggalKembali').text(tanggalKembali);
          modal.find('#modalTotalBiaya').text(totalBiaya);
          modal.find('#modalBuktiPembayaran').attr('src', bukti);
      });
  </script>
  @endpush
@endsection