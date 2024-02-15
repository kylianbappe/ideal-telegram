<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="side-nav">
        <div class="icon-nav">
            <a href="/" style="text-decoration: none; color: black;">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
            @if (request()->path() == "/" || request()->path() == "/admin/dashboard")
            @else
            <a href="#" onclick="history.back();" style="text-decoration: none; color: black;">
                <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
            </a>
            @endif
        </div>
    </div>
</body>
</html>