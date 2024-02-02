<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fintech</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>

        .navbar-brand {
            color: rgb(4, 35, 14);
        }

        .navbar-nav .nav-item .nav-link {
            color: black;
        }
        .navbar-nav .nav-item .nav-link:hover {
            color: #112ae6;
        }

        .dropdown-menu {
            background-color: #17515ff8;
        }

        .dropdown-menu .dropdown-item {
            color: white;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #ffc107;
            color: black;
        }
        @media print {
  .print-button {
      display: none;
  }
}

@media print {
  .modal-footer .btn-secondary {
      display: none;
  }
}

    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <img src="{{ asset('assets/images/logo.png')}}" alt="" width="40" height="30">
                <a class="navbar-brand">
                AdamFinTech
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth

                            @if (Auth::user()->role_id === 3)
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Home' ? 'active' : '' }}" aria-current="page"
                                        href="{{ route('home') }}">Home</a>
                                </li>
                            @endif
                            @if (Auth::user()->role_id === 2)
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Home' ? 'active' : '' }}" aria-current="page"
                                        href="{{ route('home')}}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Menu' ? 'active' : '' }}" aria-current="page"
                                        href="{{ route('menu') }}">Menu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Data Transaksi' ? 'active' : '' }}" aria-current="page"
                                        href="{{ route('data_transaksi') }}">Transaction Dashboard</a>
                                </li>
                            @endif
                            @if (Auth::user()->role_id === 1)
                                <li class="nav-item">
                                    <a class="nav-link {{ $page == 'Home' ? 'active' : '' }}" aria-current="page"
                                        href="{{ route('home') }}">Home</a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                            @endif

                            @if (Route::has('register'))
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} ({{ Auth::user()->role->name }})
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            @yield('content')
        </main>
    </div>
</body>

</html>
