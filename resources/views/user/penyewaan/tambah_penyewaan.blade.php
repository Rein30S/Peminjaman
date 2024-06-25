@extends('layouts.user.app')

@section('content')
<div class="container pt-3 pb-3">
    <h1>Tambah Penyewaan Barang</h1>
    @if(session('error'))
        <script>
            alert('{{ session('error') }}');
        </script>
    @endif
    <form action="{{ route('penyewaan_member.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="id_user">Nama User</label>
            <input type="text" name="nama_user" id="nama_user" class="form-control" value="{{ $user->nama_lengkap }}" readonly>
            <input type="hidden" name="id_user" id="id_user" value="{{ $user->id }}">
        </div>        

        <div id="barang-wrapper">
            <div class="barang-group" data-index="0">
                <div class="form-group">
                    <label for="id_barang_0">Nama Barang</label>
                    <select name="barang[0][id_barang]" id="id_barang_0" class="form-control barang-select" required>
                        <option value="">Pilih Barang</option>
                        @foreach($barang as $brg)
                            <option value="{{ $brg->id }}" data-harga="{{ $brg->harga }}">{{ $brg->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga_0">Harga per Barang</label>
                    <input type="number" name="barang[0][harga]" id="harga_0" class="form-control harga-input" readonly>
                </div>
                <div class="form-group">
                    <label for="jumlah_0">Jumlah</label>
                    <input type="number" name="barang[0][jumlah]" id="jumlah_0" class="form-control jumlah-input" required>
                </div>
                <div class="form-group">
                    <label for="total_harga_0">Total Harga</label>
                    <input type="number" name="barang[0][total_harga]" id="total_harga_0" class="form-control total-harga-input" readonly>
                </div>
                <button type="button" class="btn btn-danger remove-barang mb-3">Hapus</button>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="add-barang">Tambah Barang</button>

        <div class="form-group">
            <label for="tanggal_sewa">Tanggal Sewa</label>
            <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal_kembali">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="bukti_pembayaran">Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var maxFields = 5;
        var wrapper = $("#barang-wrapper");
        var addButton = $("#add-barang");
        var index = 1;

        function calculateTotalHarga(index) {
            var harga = $('#harga_' + index).val();
            var jumlah = $('#jumlah_' + index).val();
            var totalHarga = harga * jumlah;
            $('#total_harga_' + index).val(totalHarga);
        }

        function updateBarangOptions() {
            var selectedIds = [];
            wrapper.find('.barang-select').each(function() {
                var selectedId = $(this).val();
                if (selectedId) {
                    selectedIds.push(parseInt(selectedId));
                }
            });

            wrapper.find('.barang-select').each(function() {
                var currentSelect = $(this);
                var currentSelectedId = currentSelect.val();
                currentSelect.find('option').each(function() {
                    var option = $(this);
                    var optionValue = parseInt(option.val());
                    if (selectedIds.includes(optionValue) && optionValue !== parseInt(currentSelectedId)) {
                        option.hide();
                    } else {
                        option.show();
                    }
                });
            });

            if (selectedIds.length >= maxFields) {
                addButton.hide();
            } else {
                addButton.show();
            }
        }

        wrapper.on('change', '.barang-select', function() {
            var selectId = $(this).attr('id');
            var selectedOption = $(this).find('option:selected');
            var harga = selectedOption.data('harga');
            var index = selectId.split('_')[2];
            $('#harga_' + index).val(harga);
            calculateTotalHarga(index);
            updateBarangOptions();
        });

        wrapper.on('input', '.jumlah-input', function() {
            var inputId = $(this).attr('id');
            var index = inputId.split('_')[1];
            calculateTotalHarga(index);
        });

        $(addButton).click(function(e) {
            e.preventDefault();
            if (index < maxFields) {
                var newBarangGroup = `
                    <div class="barang-group" data-index="${index}">
                        <div class="form-group">
                            <label for="id_barang_${index}">Nama Barang</label>
                            <select name="barang[${index}][id_barang]" id="id_barang_${index}" class="form-control barang-select" required>
                                <option value="">Pilih Barang</option>
                                @foreach($barang as $brg)
                                    <option value="{{ $brg->id }}" data-harga="{{ $brg->harga }}">{{ $brg->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga_${index}">Harga per Barang</label>
                            <input type="number" name="barang[${index}][harga]" id="harga_${index}" class="form-control harga-input" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_${index}">Jumlah</label>
                            <input type="number" name="barang[${index}][jumlah]" id="jumlah_${index}" class="form-control jumlah-input" required>
                        </div>
                        <div class="form-group">
                            <label for="total_harga_${index}">Total Harga</label>
                            <input type="number" name="barang[${index}][total_harga]" id="total_harga_${index}" class="form-control total-harga-input" readonly>
                        </div>
                        <button type="button" class="btn btn-danger remove-barang mb-3">Hapus</button>
                    </div>`;
                $(wrapper).append(newBarangGroup);
                index++;
                if (index === maxFields) {
                    addButton.hide();                                                                                                                                                                                                                                                                                                                                                                              
                }
                updateBarangOptions();
            }
        });

        wrapper.on('click', '.remove-barang', function(e) {
            e.preventDefault();
            $(this).closest('.barang-group').remove();
            updateBarangOptions();
            index--;
            if (index < maxFields) {
                addButton.show();
            }
        });

        updateBarangOptions();
    });
</script>
@endsection