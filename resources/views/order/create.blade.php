@extends('templates.app', ['title' => 'Tambah Pembelian'])

@section('dynamic-contents')
    <h1 class="mt-5 text-center">Pembelian Buku</h1>
    <div class="container mt-5" style="width: 50%">
        <form class="card m-auto p-5" action="{{ route('pelanggan.order.store') }}" method="POST">
            @csrf
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $errors)
                        <li>{{ $errors }}</li>
                    @endforeach
                </ul>
            @endif
            @if (Session::get('failed'))
                <div class="alert alert-danger"> {{ Session::get('failed') }} </div>
            @endif
            <p>Akun: <span class="text-warning">{{ Auth::user()->email }}</span> </p>
            <div class="mb-3 mt-3 row">
                <label class="col-sm-3 col-form-label" for="name_customer">Nama Pembeli:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="name_customer" id="name_customer" placeholder="nama anda">
                </div>
            </div>
            <div class="mb-3 mt-3 row">
                <label class="col-sm-3 col-form-label" for="notes">Catatan:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="notes" id="notes" placeholder="catatan">
                </div>
            </div>
            <div class="mb-3 mt-3 row">
                <label class="col-sm-3 col-form-label" for="books">Buku:</label>
                <div class="col-sm-9">
                    <select name="books[]" id="books" class="form-select">
                        <option selected hidden option>Pembelian 1</option>
                        @foreach ($books as $index => $items)
                            <option value="{{ $items['id'] }}"> {{ $items['name'] }} = Rp.{{number_format( $items['price'], 2, ',', '.')}} </option>
                        @endforeach
                    </select>
                    <div id="wrap-books"></div>
                    <br>
                    <p style="cursor: pointer" class="text-primary" id="add-select">Tambah Buku +</p>
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-block btn-primary">Konfirmasi Pembelian</button>
        </form>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Tentukan nilai awal untuk nomor urut sebagai 2
        let no = 2;

        // Ketika elemen dengan id "add-select" diklik, jalankan fungsi berikut 
        $("#add-select").on("click", function() {
            // Tag HTML yang akan ditambahkan
            let el = `<br><select name="books[]" id="books" class="form-select">
                        <option selected hidden option>Pembelian ${no}</option>
                        @foreach ($books as $index => $items)
                            <option value="{{ $items['id'] }}"> {{ $items['name'] }} = {{$items['price']}}</option>
                        @endforeach
                    </select>`

            // Tambahkan elemen HTML baru ke dalam elemen dengan id "wrap-medicines"
            $("#wrap-books").append(el);

            // Tambahkan 1 ke nilai nomor urut untuk persiapan penambahan berikutnya
            no++;
        });
    </script>
@endpush
