@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Daftar User</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat Rumah</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->jenis_kelamin }}</td>
                        <td>{{ $user->tanggal_lahir }}</td>
                        <td>{{ $user->alamat_rumah }}</td>
                        <td>{{ $user->nomor_telepon }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->level }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
