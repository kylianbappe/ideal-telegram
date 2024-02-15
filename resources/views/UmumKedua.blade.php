<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Pemeriksaan Pasien Umum</title>
</head>

<body>
    @include('components.Navbar')
    <div class="container-pasien">
        <div class="fill-container">
            @include('components.Sidebar')

        </div>
        <div class="content-pasien">
            <div class="table-container">
                <h1 class="heading-pemeriksaan-pasien">Tindakan Gigi</h1>
                <div class="border-pertabel"></div>
                <div class="admedika-container">
                    <div class="container-tind-gigi">
                        <h2 class="namaPasienAdmedika">Jenis Tindakan</h2>
                        <div class="container-spanAdmedika">
                            <input type="text" class="soap">
                        </div>
                        <h2 class="namaPasienAdmedika">Biaya</h2>
                            <div class="spanGray">
                                <input type="number" class="namaDokter">
                            </div>
                    </div>
                </div>
                <h1 class="heading-pemeriksaan-pasien">SOAP</h1>
                <div class="border-pertabel"></div>
                <div class="container-soap">
                    <div class="child-soap">
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <h2 class="namaPasienAdmedika">Subjective</h2>
                                <div class="container-spanAdmedika">
                                        <textarea type="text" class="soap"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <h2 class="namaPasienAdmedika">Objective</h2>
                                <div class="container-spanAdmedika">
                                        <textarea type="text" class="soap"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <h2 class="namaPasienAdmedika">Assesment</h2>
                                <div class="container-spanAdmedika">
                                        <textarea type="text" class="soap"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tindakanGigi">
                            <div class="itemTindakanGigi">
                                <h2 class="namaPasienAdmedika">Plan</h2>
                                <div class="container-spanAdmedika">
                                        <textarea type="text" class="soap"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-container">
                        <img src="{{ asset('/img/calendar.png') }}" class="cldnr"/>
                    </div>
                </div>
                <div class="submitForm">
                    <button class="submitAdmedika">DONE</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>