<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();

if ($user->isAdmin == 0) {
    header("Location: /");
    exit;
}
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Admin Dashboard</title>
</head>

<body>
    @include('components.Navbar')
    <div class="content-home">
        @include('components.Sidebar')
        <div class="content">
            <div class="top-content">
                <div class="jumlah-pasien-container">
                    <span class="jmlhpasien">JUMLAH PASIEN BULAN INI</span>
                    <div class="border-gap-home"></div>
                    <span class="total-jumlah-pasien">{{ $jumlahPasienBulanIni }}</span>
                </div>
                <div class="jumlah-pasien-selesai-container">
                    <span class="jmlhpasien">JUMLAH PASIEN HARI INI</span>
                    <div class="border-gap-home"></div>
                    <span class="total-jumlah-pasien">{{ $jumlahPasienHariIni }}</span>
                </div>
            </div>
            <div class="mid-content">
                <a href="/pasien/buat" style="text-decoration: none; color: black;">
                    <div class="box-selection">
                        <div class="box-item">
                            <img class="select-menu" src="{{ asset('/img/plus.png') }}" />
                            <span class="selection">Tambah Daftar Pasien Dokter Gigi</span>
                        </div>
                    </div>
                </a>
                <a href="/daftarpasien" style="text-decoration: none; color: black;">
                    <div class="box-selection">
                        <div class="box-item">
                            <img class="select-menu" src="{{ asset('/img/letter.png') }}" />
                            <span class="selection">Daftar Pasien Dokter Gigi</span>
                        </div>
                    </div>
                </a>
                <a href="/antrianpasien" style="text-decoration: none; color: black;">
                    <div class="box-selection">
                        <div class="box-item">
                            <img class="select-menu" src="{{ asset('/img/sit.png') }}" />
                            <span class="selection">Antrian Pasien Dokter Gigi</span>
                        </div>
                    </div>
                </a>
                <a href="/pembukuan-transaksi" style="text-decoration: none; color: black;">
                    <div class="box-selection">
                        <div class="box-item">
                            <img class="select-menu" src="{{ asset('/img/book.png') }}" />
                            <span class="selection">Pembukuan Transaksi Dentika Klinik Gigi</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>