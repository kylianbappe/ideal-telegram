<?php

use Illuminate\Support\Facades\Auth;

$user = Auth::user();

$checkAuth = Auth::check();

if (!$checkAuth) {
    header("Location: /login");
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="nav-container">
        @if (!$checkAuth)
        <div class="user-info">
            <div class="iconProfile">
            </div>
            <h2></h2>
        </div>
        @else
        <div class="user-info">
            <a href="/informasiakun" style="text-decoration: none; color: black;">
                <div class="iconProfile">
                    <i class="fa fa-user-circle-o" style="cursor: pointer;" aria-hidden="true"></i>
                </div>
            </a>
            <a href="/informasiakun" style="text-decoration: none; color: black;">
                <span style="cursor: pointer; font-size: 22px;">{{ $user->nama }}</span>
            </a>
        </div>
        @endif
        <img class="logo-nav" src="{{ asset('/img/logo.png') }}" />
    </div>
</body>
</html>