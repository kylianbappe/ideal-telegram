<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Pembayaran</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <div class="table-container">
                <span class="heading-pemeriksaan-pasien">Pembayaran ({{ $jenisPasien->nama}}_{{ $jenisPasien->nkp}})</span>
                <div class="border-pertabel"></div>
                <form action="{{ route('bayarInvoice', ['id' => $totalHargaSoap->id]) }}" method="POST" id="formBayar">
                @csrf
                <div class="admedika-container">
                    <div class="container-tind-nambulan">
                        <div class="wrapping-tindk">
                            <span class="titleSoap">Jenis Pasien</span>
                            <div class="parent-dd">
                                <div class="dropdown-payment">
                                   <span>{{ $totalHargaSoap->jenis_pasien}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="wrapping-tindk">
                            <span class="titleSoap">Nama Admin</span>
                            <div class="parent-dd">
                                <div class="dropdown-payment">
                                    @php
                                        $namaAdmin = Auth::user()->nama;
                                    @endphp
                                    <span>{{ $namaAdmin}}</span>
                                    <input type="hidden" name="nama-admin" value="{{ $namaAdmin}}">
                                </div>
                            </div>
                        </div>
                        <div class="wrapping-tindk">
                            <span class="titleSoap">Jumlah Pembayaran</span>
                            <div class="parent-dd">
                                <div class="dropdown-payment">
                                    @php
                                        $price = json_decode($totalHargaSoap->biaya, true);
                                        $total = array_sum($price);
                                    @endphp
                                    <span>Rp. {{ number_format($total, 0, ',', '.')}}</span>
                                    <input type="hidden" name="harga" value="{{ $total}}">
                                </div>
                            </div>
                        </div>
                        <div class="wrapping-tindk">
                            <span class="titleSoap">Mode Pembayaran</span>
                            <div class="parent-dd-payment">
                                <div class="dropdown">
                                    @if (!$metodePembayaran)
                                    <select class="asuransi" name="metode">
                                        <option disabled selected>Pilih</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Debit">Debit</option>
                                        <option value="Ewallet">E-Wallet</option>
                                    </select>
                                    @else
                                    <select class="asuransi" name="metode">
                                        <option disabled selected>{{ $metodePembayaran->modepembayaran}}</option>
                                    </select>
                                    @endif
                                </div>
                                @if ($totalHargaSoap->status_pembayaran == 0)
                                @else
                                <span style="color: #81AA8B; width: 100%;" id="code">Pembayaran Berhasil</span>
                                @endif
                                @if (session('error'))
                                <span style="color: red; width: 100%;" id="code">{{session('error')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if ($totalHargaSoap->status_pembayaran == 1)
                @else
                    <div class="submitForm-laporan">
                        <button class="submitAdmedika" id="preventSubmit" style="">Bayar</button>
                    </div>
                @endif
                </form>
                @if ($totalHargaSoap->status_pembayaran == 0)
                @else
                <div class="xyzbca" id="kembaliId">
                    <div class="gaps-xz"></div>
                    <div class="gaps-xz">
                    <form action="{{ route('deleteAntrianAfterPayment', ['id' => $totalHargaSoap->noresep]) }}" method="POST">
                        @csrf
                        @method('DELETE') 
                        <button class="submitAdmedika">Kembali</button>
                    </form>
                    <a href="{{ route('invoice', ['id' => $totalHargaSoap->invoice_id]) }}" onclick="history.back();" style="text-decoration: none; color: black;">
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


<script>
    const formNullTagihan = document.getElementById('formDone')
    const formAction = document.getElementById('formBayar')
    const submitForm = document.querySelector('.submitForm-laporan')
    const bayarBtn = document.getElementById('submitPembayaran')
    const kembaliBtn = document.getElementById('kembali')
    const kembaliForm = document.getElementById('kembaliId')
    const tagihanFalse = document.getElementById('codeErrors')
    
    formNullTagihan.addEventListener('submit', function (e) {
        e.preventDefault();
    })

    bayarBtn?.addEventListener("click", function (e) {
        e.preventDefault();
    })

    kembaliBtn?.addEventListener("click", function() {
        kembaliForm.style.display = 'none';
        submitForm.style.display = 'flex';
        document.getElementById('preventSubmit').style.display = 'block';
        document.getElementById('code').style.display = 'none';
    })
    
    document.getElementById('preventSubmit')?.addEventListener("click", function (e) {
        e.preventDefault();
        tagihanFalse.style.display = 'block';
        console.log("clicked");
    })

</script>