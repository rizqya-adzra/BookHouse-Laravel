<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/bookmarks.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fontawesome.com/icons/trash?f=classic&s=solids">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <svg xmlns="http://www.w3.org/2000/svg" width="5" height="5" class="d-none" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path fill="green"
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
    </svg>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    @stack('style')
    <title> {{ $title }} </title>
</head>

<body style="background-color: #eaeff0">
@if (Auth::check())
    <nav class="navbar d-flex justify-content-around" style="background-color: white; box-shadow: 0px 3px 0px 0px #836FFF">
        <div>
            <a href="" class="navbar-brand">Qya's Bookhouse</a>
        </div>
        <div>
            <ul class=" navbar-nav d-flex flex-row" style="gap:20px">
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
                    <a class="nav-link text-danger" onclick="logoutModal()" style="cursor:pointer">Logout</a>
                </li>
            </ul>
            @else
            <nav class="navbar d-flex justify-content-center" style="background-color: white; box-shadow: 0px 3px 0px 0px #836FFF">
                <div>
                    <a href="" class="navbar-brand">Qya's Bookhouse</a>
                    </div>
            </nav>
                @endif
                <div class="modal fade" id="ModalLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{route('logout')}}" id="form-logout" method="GET">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    apakah anda yakin Untuk Logout?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-danger">Tetap Logout</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </nav>

    @yield('dynamic-contents')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    
    @push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function logoutModal() {
            let action = '{{ route('logout') }}';
            $('#form-logout').attr('action', action);
            $('#ModalLogout').modal('show');
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize()
            });
        }
        </script>
    @endpush
    @stack('script')
</body>
</html>

