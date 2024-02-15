<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Informasi Akun</title>
</head>
<body>
@include('components.Navbar')
    <div class="content-home">
        @include('components.Sidebar')
        <div class="container-infoakun">
            <div class="heading-infoakun"><h1>Informasi Akun</h1></div>
            <div class="content-infoakun">
            <a href="/resetpassword" style="text-decoration: none; color: black;">
                <div class="bg-account-nav">
                    <img src="{{ asset('/img/lock.png') }}" class="lock" />
                    <span class="totalSoap">Ganti Password</span class="totalSoap">
                </div>
            </a>
            <a href="{{ route('logout') }}" style="text-decoration: none; color: black;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="bg-account-nav">
                    <img src="{{ asset('/img/logout.png') }}" class="lock" />
                    <span class="totalSoap">Logout</span class="totalSoap">
                </div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf <!-- CSRF token -->
            </form>
            </div>
        </div>
    </div>
</body>
</html>