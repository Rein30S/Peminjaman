@extends('layouts.user.app')

@section('title', 'User Dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index_user') }}">Home</a></li>
                    <li class="breadcrumb-item active">User Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row d-flex align-items-center" style="height: 50vh;">
            <div class="col-md-4">
                <img src="{{ asset('dist/img/logo.png') }}" alt="Logo" style="max-width: 100%;">
            </div>
            <div class="col-md-8">
                <h2>Selamat Datang di NIU PICNIC</h2>
                <h4>Syarat dan Ketentuan:</h4>
                <ol>
                    <li>Meninggalkan Kartu Identitas yang masih berlaku (KTP, SIM, KTM, Kartu Pelajar)</li>
                    <li>Jika ada kerusakan/kehilangan, customer wajib membayar sesuai kerusakan/menggantinya</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection