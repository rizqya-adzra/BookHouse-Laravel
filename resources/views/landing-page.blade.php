@extends('templates.app', ['title' => 'Landing Page'])

@section('dynamic-contents')
    <center>
        <div class="mt-5 border-warning" style="width: 20%">
            @if (Session::get('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
        <div>
            <h1 class="mt-5">Selamat datang <span class="text-warning"
                    style="font-weight: bold">{{ Auth::user()->name }}!</span></h1>
        </div>

        <div>
            <div class="" style="width: 40%">
                <hr>
                @if (Auth::check())
                    @if (Auth::user()->role === 'admin')
                        <p>Aplikasi ini digunakan untuk pegawai perpustakaan untuk Mengelola Data Buku dan Data Pengguna</p>
                    @endif
                    @if (Auth::user()->role === 'pelanggan')
                        <p>Anda bisa memulai membeli buku dengan mengklik halaman Pemesanan Buku</p>
                    @endif
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-center mt-5" style="gap: 50px">
            <div class="card p-5" style="max-width: 300px">
                <h4>Kelola data Buku</h4>
                <img src="{{ Asset('assets/bookhome1.jpeg') }}" alt="">
                <a href=" {{ route('books') }} " class="btn btn-warning mt-3">Kelola↗️</a>
            </div>
            <div class="card p-5" style="max-width: 300px">
                <h4>Kelola data Akun</h4>
                <img src="{{ Asset('assets/accounthome1.jpeg') }}" alt="">
                <a href=" {{ route('accounts') }} " class="btn btn-warning mt-3">Kelola↗️</a>
            </div>
        </div>
    </center>
@endsection
