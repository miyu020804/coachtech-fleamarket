<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/items.css') }}">
    @stack('style')
    @yield('head')
    @yield('styles')
</head>


<body class="bg-white overflow-hidden">
    <header class="bg-black h-16">
        <div class="w-full h-16 flex items-center justify-between px-4">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-10">
            @auth
                <form action="{{ route('items.search') }}" method="GET" class="site-header__search">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="何をお探しですか?"
                        class="site-header__search-input" />
                </form>
            @endauth
            @auth
                <a href="{{ route('mypage.index') }}" class="mypage-link">マイページ</a>
                <a href="#" class="mypage-link"
                    onclick="event.preventDefault();
        document.getElementByTd('logout-form').submit();">
                    ログアウト</a>
                <a href="{{ route('items.create') }}" class="button-sell">出品</a>
            @endauth
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </header>

    <main class="flex items-center justify-center py-0">
        @yield('content')
    </main>
    @auth
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
            @csrf
        </form>
    @endauth
</body>

</html>
