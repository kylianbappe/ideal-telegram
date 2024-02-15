<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Riwayat Pasien - Belum Datang</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')
        </div>
        <div class="content-pasien">
            <div class="table-container">
                <div class="admedika-container">
                    <div class="container-tind-nambulan">
                       <div class="wrapping-tindk">
                            <span class="titleSoap">Jenis Pasien</span>
                            <div class="container-spanAdmedika">
                                <span class="tindakan">{{ $pasien->jenis }}</span>
                            </div>
                       </div>
                       <div class="wrapping-tindk">
                            <span class="titleSoap">Jenis Tindakan</span>
                            <div class="container-spanAdmedika">
                                @php
                                    $soapArray = json_decode($soap->tindakan, true);
                                @endphp
                                @if (count($soapArray) == 1)
                                    <span class="tindakan">{{ $soapArray[0] }}</span>
                                @else
                                @foreach ($soapArray as $tindakanArray)
                                    <span class="tindakan">{{ $tindakanArray }}</span>
                                @endforeach
                                @endif
                            </div>
                       </div>
                    </div>
                </div>
                <span class="heading-pemeriksaan-pasien">Riwayat Pasien Terakhir Selama 6 Bulan</span>
                <div class="border-pertabel"></div>
                <div class="container-soap">
                    <div class="child-soap">
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <span class="titleSoap">Subjective</span>
                                <div class="container-spanAdmedika">
                                    @php
                                        $subjektifArray = json_decode($soap->subjektif, true);
                                    @endphp
                                    @if (count($subjektifArray) == 1)
                                        <span>{{ $subjektifArray[0] }}</span>
                                    @else
                                    @foreach ($subjektifArray as $subjective)
                                        <span>{{ $subjective }}</span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <span class="titleSoap">Objective</span>
                                <div class="container-spanAdmedika">
                                    @php
                                        $objektifArray = json_decode($soap->objektif, true);
                                    @endphp
                                    @if (count($objektifArray) == 1)
                                        <span>{{ $objektifArray[0] }}</span>
                                    @else
                                    @foreach ($objektifArray as $objektif)
                                        <span>{{ $objektif }}</span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <span class="titleSoap">Assesment</span>
                                <div class="container-spanAdmedika">
                                    @php
                                        $assesmentArray = json_decode($soap->assesment, true);
                                    @endphp
                                    @if (count($assesmentArray) == 1)
                                        <span>{{ $assesmentArray[0] }}</span>
                                    @else
                                    @foreach ($assesmentArray as $assesment)
                                        <span>{{ $assesment }}</span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <span class="titleSoap">Plan</span>
                                <div class="container-spanAdmedika">
                                    @php
                                        $planArray = json_decode($soap->plan, true);
                                    @endphp
                                    @if (count($planArray) == 1)
                                        <span>{{ $planArray[0] }}</span>
                                    @else
                                    @foreach ($planArray as $plan)
                                        <span>{{ $plan }}</span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" onclick="history.back();" style="text-decoration: none;">
                    <div class="submitForm">
                        <button class="submitAdmedika">DONE</button>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    let clicked = false;
    const dd = document.querySelector('.dropdown');
    const pdd = document.querySelector('.parent-dd');
    const so = document.querySelector('.selectOption')
    dd.addEventListener("click", (e) => {
        if (clicked === false) {
            clicked = true;
            pdd.style.height = "200px"
            so.style.display = "block"
        } else {
            clicked = false;
            pdd.style.height = "100%"
            so.style.display = "none"
        }
    })
    
</script>