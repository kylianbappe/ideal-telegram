<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Daftar Pasien - Admin</title>
</head>
<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <div class="table-container">
                <form action="/antrian" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $pasien->id }}">
                <div class="admedika-container">
                    <div class="container-tind-nambulan">
                        <div class="wrapping-tindk">
                            <span class="namaPasienAdmedika">Jenis Pasien</span>
                            <div class="parent-dd">
                                <div class="dropdown">
                                    <select class="asuransi" name="jenis">
                                        <option disabled selected>Pilih</option>
                                        <option value="Pasien Umum">Pasien Umum</option>
                                        <option value="Asuransi Admedika">Asuransi Admedika</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="wrapping-tindk">
                            <span class="namaPasienAdmedika">Pilih Dokter Gigi</span>
                            <div class="parent-dd">
                                <div class="dropdown">
                                    <select class="asuransi" name="dokter">
                                        <option disabled selected>Pilih</option>
                                        @foreach ($dokter as $dktr)
                                        <option value="{{ $dktr->nama}}">{{ $dktr->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="submitForm-laporan">
                    <button class="submitAdmedika">Done</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>