<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>FashionablyLate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">

    @yield('css')
</head>
<body>

<header class="header">
    <div class="header-inner">
        <h1 class="logo">
            <a href="{{ route('contact.index') }}">FashionablyLate</a>
        </h1>

        <div class="header-right">

    @guest

    @unless(request()->routeIs('contact.*'))
        @if(request()->routeIs('register'))
            <a href="{{ route('login') }}" class="header-btn">login</a>

        @elseif(request()->routeIs('login'))
            <a href="{{ route('register') }}" class="header-btn">register</a>

        @else
            <a href="{{ route('login') }}" class="header-btn">login</a>
            <a href="{{ route('register') }}" class="header-btn">register</a>
        @endif
    @endunless

    @else
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="header-btn">Logout</button>
    </form>
    @endguest



        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

</body>
</html>
