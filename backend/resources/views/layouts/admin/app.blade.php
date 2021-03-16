<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header>
    <div class="container max-w-screen-xl mx-auto  p-5 mb-5">
        <nav class="flex justify-between">
            <div class="my-navbar-left">
                @if(Auth::check())
                <a href="{{ route('admin.foods.index', ['id' => Auth::user()->categories()->first()->id]) }}">
                @else
                <a href="{{ route('admin.welcome')  }}">
                @endif
                Stock</a>
            </div>
            <div class="my-navbar-right">
                @if(Auth::check())
                    <span class="my-navbar-item">{{ Auth::user()->name }}さん</span>
                    ｜
                    <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
                @else
                    <a class="my-navbar-item" href="{{ route('admin.login') }}">ログイン</a>
                @endif
            </div>
        </nav>
    </div>
</header>
<main>
@if(Auth::check())
    <script>
        document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
        });
    </script>
@endif
@yield('content')
</main>
@yield('script')
</body>
</html>
