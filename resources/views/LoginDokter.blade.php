<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::check();

if ($user) {
    header("Location: /");
    exit;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;700&family=Playfair+Display:wght@400;500&family=Radley&family=Roboto:ital,wght@0,400;0,500;1,300&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('/img/logo.png') }}">
    <title>Login</title>
</head>

<body>
    @include('components.Navbar')
    <div class="loginDokterContainer">
    <form action="/login/proses" method="POST" class="lf">
        @csrf
        <div class="formAuth">
            <div class="formInput">
                <x-auth-validation-errors class="error" :errors="$errors" />
                <input class="auth" name="email" value="{{ Session::get('email') }}" type="email" placeholder="Email"/>
                <input class="auth" name="password" value="{{ Session::get('password') }}" type="password" placeholder="Password"/>
            </div>
            <div class="submitBox">
                <button name="submit" type="submit" class="auth" >Login</button>
            </div>
        </div>
    </form>
    </div>
</body>

</html>