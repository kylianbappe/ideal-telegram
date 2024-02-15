<?php
    if (Auth::user()->isAdmin == 1) {
        header("Location: /admin/dashboard");
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
    <title>Home</title>
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
                    <span class="total-jumlah-pasien">{{ count($totalPasienPerBulan) }}</span>
                </div>
                <div class="jumlah-pasien-selesai-container">
                    <span class="jmlhpasien">PASIEN YANG SUDAH DITANGANI HARI INI</span>
                    <div class="border-gap-home"></div>
                    <span class="total-jumlah-pasien">{{ count($soapRecords) }}</span>
                </div>
            </div>
            <div class="mid-content">
                <a href="/pemeriksaan" style="text-decoration: none; color: black;">
                    <div class="box-selection">
                        <div class="box-item">
                            <img class="select-menu" src="{{ asset('/img/tooth.png') }}" />
                            <span class="selection">Pemeriksaan Pasien Dokter Gigi</span>
                        </div>
                    </div>
                </a>
                <a href="/riwayatpasien" style="text-decoration: none; color: black;">
                    <div class="box-selection">
                        <div class="box-item">
                            <img class="select-menu" src="{{ asset('/img/letter.png') }}" />
                            <span class="selection">Riwayat Pasien Dokter Gigi</span>
                        </div>
                    </div>
                </a>
                <a href="/riwayat/belum-datang" style="text-decoration: none; color: black;">
                    <div class="box-selection">
                        <div class="box-item">
                            <img class="select-menu" src="{{ asset('/img/sit.png') }}" />
                            <span class="selection">Daftar Pasien Yang Belum Datang Selama 6 Bulan Terakhir</span>
                        </div>
                    </div>
                </a>
                <a href="/laporan-pemeriksaan" style="text-decoration: none; color: black;">
                    <div class="box-selection">
                        <div class="box-item">
                            <img class="select-menu" src="{{ asset('/img/heartbeat.png') }}" />
                            <span class="selection">Laporan Pemeriksaan Oleh Dokter</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>