<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Detail Pembukuan - Pasien</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <div class="table-container">
                @if ($data == null) 
                    <h1 class="heading-pemeriksaan-pasien">Pembayaran ({{ $handlePatient->nama}}_{{ $handlePatient->nkp}})</h1>
                @else
                <h1 class="heading-pemeriksaan-pasien">Pembayaran ({{ $data->pasien}}_{{ $nkp}})</h1>
                @endif
                <div class="border-pertabel"></div>
                <div class="admedika-container">
                    <div class="container-tind-nambulan">
                        <div class="wrapping-tindk">
                            <h2 class="namaPasienAdmedika">Jenis Pasien</h2>
                            <div class="parent-dd">
                                <div class="dropdown-payment">
                                @if ($data == null) 
                                   <span>{{ $handlePatient->jenis }}</span>
                                @else
                                   <span>{{ $data->jenis_pasien}}</span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="wrapping-tindk">
                            <h2 class="namaPasienAdmedika">Nama Admin</h2>
                            <div class="parent-dd">
                                <div class="dropdown-payment">
                                @if ($data == null)
                                    <span>-</span>
                                @else
                                    <span>{{ $data->admin}}</span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="wrapping-tindk">
                            <h2 class="namaPasienAdmedika">Jumlah Pembayaran</h2>
                            <div class="parent-dd">
                                <div class="dropdown-payment">
                                    @if ($data == null)
                                        <span>Belum bayar</span>
                                    @else
                                        <span>Rp. {{ number_format( $data->totalharga, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="wrapping-tindk">
                            <h2 class="namaPasienAdmedika">Mode Pembayaran</h2>
                            <div class="parent-dd">
                                <div class="dropdown-payment">
                                    @if ($data == null)
                                        <span>-</span>
                                    @else
                                        <span>{{ $data->modepembayaran}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($data == null)
                @else
                <div class="xyzbca">
                    <div class="gaps-xz"></div>
                    <div class="gaps-xz">
                    <a href="#" onclick="history.back();" style="text-decoration: none; color: black;">
                        <button class="submitAdmedika">Kembali</button>
                    </a>
                    <a href="{{ route('invoice', ['id' => $data->id_invoice]) }}" onclick="history.back();" style="text-decoration: none; color: black;">
                        <button class="cetak-pem">Cetak</button>
                    </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>