@extends('templates.app', ['title' => 'Landing Page'])

@section('dynamic-contents')
    <section>
        <div class="mt-5 border-warning" style="width: 20%">
            @if (Session::get('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>


        @if (Auth::check())
            <div class="d-flex justify-content-center m-auto mt-5" style="width: 45%; gap:100px">
                <div class="">
                    <h1 class="mt-5" style="font-size:50px">Selamat datang <span class="text-warna"
                            style="font-weight: bold;">{{ Auth::user()->name }}!</span></h1>
                    <hr>
                    @if (Auth::user()->role === 'admin')
                        <p>Aplikasi ini digunakan untuk pegawai perpustakaan untuk Mengelola Data Buku dan Data Pengguna
                        </p>
                </div>
                <div class="d-flex justify-content-center m-auto text-center mt-5" style="gap: 50px; width:90%">
                    <div class="card p-5" style="gap: 10px; box-shadow: 1px 5px 5px 0px rgb(158, 164, 207)">
                        <h4>Kelola data Buku</h4>
                        <img src="{{ Asset('assets/bookhome2.jpeg') }}" alt=""
                            style="border-radius:5%; max-width:200px">
                        <a href=" {{ route('books') }} " class="btn btn-warning mt-3">Kelola↗️</a>
                    </div>
                    <div class="card p-5" style="gap: 10px; box-shadow: 1px 5px 5px 0px rgb(158, 164, 207)">
                        <h4>Kelola data Akun</h4>
                        <img src="{{ Asset('assets/accounthome1.jpeg') }}" alt=""
                            style="border-radius:5%; max-width:200px ">
                        <a href=" {{ route('accounts') }} " class="btn btn-warning mt-3">Kelola↗️</a>
                    </div>
                </div>
        @endif
        @if (Auth::user()->role === 'pelanggan')
            <div class="">
                <p>Website ini menyediakan pelayanan pembelian buku secara online
                </p>
            </div>
            <div class="card text-center mt-5">
                <div class="card-body" style="gap: 30px">
                    <h5 class="card-title">Mulai Pembelian Buku</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis, itaque in at ex
                        sequi ratione quis voluptate est quisquam earum. Sunt, veritatis ducimus doloremque ratione itaque
                        dolor veniam dolorum perspiciatis!</p>
                    <a href=" {{ route('pelanggan.order.create') }} " class="btn btn-warning">Beli↗️</a>
                </div>
            </div>
        @endif
        </div>
        @endif


    </section>
@endsection
