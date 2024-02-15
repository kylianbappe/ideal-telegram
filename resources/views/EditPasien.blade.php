<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Edit Data Pasien</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <div class="table-container">
                <span class="heading-pemeriksaan-pasien">Edit Data Pasien Dokter Gigi</span>
                <div class="border-pertabel"></div>
                <form action="{{ route('editPasienAksi', ['id' => $pasien->id]) }}" method="POST">
                @csrf
                <div class="tvx-container">
                    <div class="itemTvx">
                        <span class="tvx">Nama Pasien</span>
                    </div>
                    <div class="itemTvxSec">
                        <div class="container-tambahpasien">
                            <input name="nama" type="text" placeholder="{{ $pasien->nama}}" class="tmbh-pasien" />
                        </div>
                    </div>
                </div>
                <div class="tvx-container">
                    <div class="itemTvx">
                        <span class="tvx">Jenis Kelamin</span>
                    </div>
                    <div class="itemTvxSec">
                        <div class="container-tambahpasien">
                            <input name="kelamin" type="text" placeholder="{{ $pasien->kelamin}}" class="tmbh-pasien" />
                        </div>
                    </div>
                </div>
                <div class="tvx-container">
                    <div class="itemTvx">
                        <span class="tvx">Tanggal Lahir</span>
                    </div>
                    <div class="itemTvxSec">
                        <div class="container-tambahpasien">
                            <input name="lahir" type="text" placeholder="{{ $pasien->lahir}}" class="tmbh-pasien" />
                        </div>
                    </div>
                </div>
                <div class="tvx-container">
                    <div class="itemTvx">
                        <span class="tvx">Alamat</span>
                    </div>
                    <div class="itemTvxSec">
                        <div class="container-tambahpasien">
                            <input name="alamat" type="text" placeholder="{{ $pasien->alamat}}" class="tmbh-pasien" />
                        </div>
                    </div>
                </div>
                <div class="tvx-container">
                    <div class="itemTvx">
                        <span class="tvx">Nomor NIK</span>
                    </div>
                    <div class="itemTvxSecTelp">
                        <div class="container-tambahpasien">
                            <input name="nik" type="text" placeholder="{{ $pasien->nik}}" class="tmbh-pasien" />
                        </div>
                    </div>
                    <div class="itemTvxMargin"></div>
                    <div class="itemTvx">
                        <span class="tvx">No. Kartu Pasien</span>
                    </div>
                    <div class="itemTvxSecTelp">
                        <div class="container-tambahpasien">
                            <input name="nkp" type="text" placeholder="{{ $pasien->nkp}}" class="tmbh-pasien" />
                        </div>
                    </div>
                </div>
                <div class="tvx-container">
                    <div class="itemTvx">
                        <span class="tvx">No. Telp</span>
                    </div>
                    <div class="itemTvxSecTelp">
                        <div class="container-tambahpasien">
                            <input name="telpon" type="text" placeholder="{{ $pasien->telpon}}" class="tmbh-pasien" />
                        </div>
                    </div>
                    <div class="itemTvxMargin"></div>
                    <div class="itemTvxSecTelp">
                        @if (session('status'))
                                <span style="color: #81AA8B; width: 100%;">{{ session('status') }}</span>
                        @endif
                    </div>
                </div>
                <div class="submitForm">
                    <button class="submitAdmedika">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>