<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/bookmarks.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <svg xmlns="http://www.w3.org/2000/svg" width="5" height="5" class="d-none" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path fill="green"
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
    </svg>
    @stack('style')
    <title> {{ $title }} </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Qya's BooksHouse</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('landing-page') ? 'active' : '' }}"
                        href="{{ route('landing-page') }}">Home</a>
                    </li>
                    @if (Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('books') ? 'active' : '' }}"
                                    href="{{ route('books') }}">Data Buku</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('accounts') ? 'active' : '' }}"
                                    href="{{ route('accounts') }}">Kelola Akun</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('pelanggan.order.index') ? 'active' : '' }}"
                                    href="{{ route('pelanggan.order.index') }}">Pembelian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('pelanggan.contact.index') ? 'active' : '' }}"
                                    href="{{ route('pelanggan.contact.index') }}">Contact Us</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('logout') ? 'active' : '' }}"
                                href="{{ route('logout') }}">Logout</a>
                        </li>
                </ul>
                @endif
            </div>
        </div>
    </nav>

    @yield('dynamic-contents')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    @stack('script')
</body>
</html>
