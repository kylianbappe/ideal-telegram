<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Reset Password</title>
</head>
<body>
@include('components.Navbar')
    <div class="content-home">
        @include('components.Sidebar')
        <div class="container-rp">
            <div class="heading-infoakun"><h1>Informasi Akun</h1></div>
            <div class="content-resetpassword">
                <div class="form-rp">
                    <div class="maincontent-rp">
                        <div class="lockimg-container">
                            <img src="{{ asset('/img/lock.png') }}" class="lock" />
                            <h2>Ganti Password</h2>
                        </div>
                        <div class="input-rp">
                            <form action="/password-reset" method="POST">
                            @csrf
                            <div class="parentForm">
                                <div class="input-boxes">
                                    <label for="" class="name">Username</label>
                                    <div class="boxv2">
                                        <input type="text" name="nama" class="reset-password">
                                    </div>
                                </div>
                                <div class="input-boxes">
                                    <label for="" class="name">Password Lama</label>
                                    <div class="boxv2">
                                        <input type="password" name="passwordlama" class="reset-password">
                                    </div>
                                </div>
                                <div class="input-boxes">
                                    <label for="" class="name">Password Baru</label>
                                    <div class="boxv2">
                                        <input type="password" name="passwordbaru" class="reset-password">
                                    </div>
                                </div>
                                <div class="input-boxes">
                                    <label for="" class="name">Konfirmasi Password</label>
                                    <div class="boxv2">
                                        <input type="password" name="konfirmasipassword" class="reset-password">
                                    </div>
                                </div>
                            </div>
                            <div class="rp-submit-container">
                                <button class="submit-rp">Submit</button>
                            </div>
                            <x-auth-validation-errors class="error" :errors="$errors" />
                            @if (session('status'))
                                <div style="color: #81aa8b; font-weight: bold;">{{ session('status')}}</div>
                            @elseif (session('error'))
                                <div style="color: red; font-weight: bold;">{{ session('error')}}</div>
                            @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>