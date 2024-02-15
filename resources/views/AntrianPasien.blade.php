<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Antrian Pasien</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <div class="table-container">
                <span class="heading-pemeriksaan-pasien">Antrian Pasien Dokter Gigi</span>
                <div class="border-pertabel"></div>
                <div class="laporan-section">
                    <div style="margin-right: 5px; width: 25%;">
                        <span class="judul">No. Kartu Pasien</span>
                    </div>
                    <div style="margin-right: 5px; width: 20%;">
                        <span class="judul">Nama Pasien</span>
                    </div>
                    <div style="margin-right: 5px; width: 15%;">
                        <span class="judul">Dokter</span>
                    </div>
                    <div style="margin-right: 5px; width: 15%;">
                        <span class="judul">Status Penanganan</span>
                    </div>
                </div>
                <div class="border-pertabel"></div>
                @foreach ($pasienBerdokter as $pasien)
                <div class="laporan-section-admin" data-value="{{ $pasien->id}}">
                    <div style="margin-right: 5px; width: 25%;">
                        <span class="nkp">{{ $pasien->nkp}}</span>
                    </div>
                    <div style="margin-right: 5px; width: 20%;">
                        <span class="nama">{{ $pasien->nama}}</span>
                    </div>
                    <div style="margin-right: 5px; width: 15%;">
                        <span class="nama">{{ $pasien->dokter}}</span>
                    </div>
                    <div style="margin-right: 5px; width: 13%;">
                        @if ($pasien->selesai == 1)
                        <a href="{{ route('checkout', ['nama' => $pasien->nama, 'idresep' => $pasien->noresep]) }}" style="text-decoration: none; color: black; margin-right: 25px;">
                            <span class="periksa">Selesai</span>
                        </a>
                            @else
                            <span class="periksa">Belum ditangani</span>
                            @endif
                    </div>
                    <form action="{{ route('hapusAntrian', ['id' => $pasien->id]) }}" method="POST" id="submitForm" class="form{{ $pasien->id}}">
                        @csrf
                        @method('DELETE')
                        <div class="item-p-c">
                            <img src="{{ asset('/img/cross.png') }}" class="delete" style="height: 30px; width: 30px; cursor: pointer;"/>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>


<script>
    const deleteImg = document.querySelectorAll('.delete');
    deleteImg.forEach((dmg)=>{
        dmg.addEventListener("click", function () {
            const formPasien = '.form' + this.closest('.laporan-section-admin').dataset.value
            console.log(formPasien)
            document.querySelector(formPasien).submit();
        })
    })



</script>