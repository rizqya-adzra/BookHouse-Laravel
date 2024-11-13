@extends('templates.app', ['title' => 'Tambah Pembelian'])

@section('dynamic-contents')
    <h1 class="mt-5 text-center">Pembelian Buku</h1>
    <div class="container mt-5" style="width: 50%">
        <form class="card m-auto p-5" style="box-shadow: 0px 1px 18px 1px rgb(195, 201, 250)" action="{{ route('pelanggan.order.store') }}" method="POST">
            @csrf
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ol>
                </div>
            @endif --}}
            @if (Session::get('failed'))
                <div class="alert alert-danger"> {{ Session::get('failed') }} </div>
            @endif
            <p>Akun: <span class="text-info">{{ Auth::user()->email }}</span> </p>
            <div class="mb-3 mt-3 row">
                <label class="col-sm-3 col-form-label" for="name_customer">Nama
                    Pembeli:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="name_customer" id="name_customer"
                        placeholder="nama anda" value="{{ old('name_customer') }}">
                        @error('name_customer')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                </div>
            </div>
            <div class="mb-3 mt-3 row">
                <label class="col-sm-3 col-form-label" for="notes">Catatan:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="notes" id="notes" placeholder="catatan" value="{{ old('notes') }}">
                    @error('notes')
                    <small class="text-danger"> {{ $message }} </small>    
                    @enderror
                </div>
            </div>
            @if (old('books'))
                @foreach (old('books') as $no => $item)
                    <div class=" mt-3 row" id="books-{{ $no+1 }}">
                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="books">Buku {{ $no+1 }} :</label>
                            <div class="col-sm-9" style="gap: 20px">
                                <div class="d-flex">
                                    <select name="books[]" id="books" class="form-select">
                                        <option disabled selected hidden>Pembelian {{ $no+1 }}</option>
                                        @foreach ($books as $index => $items)
                                            <option value=" {{ $items['id'] }} "
                                                {{ $item == $items['id'] ? 'selected' : '' }}>
                                                {{ $items['name'] }} = Rp.
                                                {{ number_format($items['price'], 2, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                    @error('books')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                    <div style="margin-left: 10px">
                                        @if ($no > 0)
                                            <span class="btn btn-outline-danger"
                                                style="cursor: pointer; font-weight:bold; padding:10px; color:"
                                                onclick="deleteSelect('books-{{ $no }}')"><i class="fa fa-times "
                                                    aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mt-3 row">
                    <div class="row">
                        <label class="col-sm-3 col-form-label" for="books">Buku 1 :</label>
                        <div class="col-sm-9">
                            <select name="books[]" id="books" class="form-select">
                                <option selected hidden option>Pembelian 1</option>
                                @foreach ($books as $index => $items)
                                    @if ($items['stock'] > 0)
                                        <option value="{{ $items['id'] }}"> {{ $items['name'] }} =
                                            Rp.{{ number_format($items['price'], 2, ',', '.') }} </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('books')
                                    <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                    </div>
            @endif
            <div class="">
                <div class="" id="wrap-books"></div>
                <br>
                <p style="cursor: pointer" class="text-primary" id="add-select">Tambah Buku +</p>
            </div>
            <button type="submit" class="btn btn-block btn-primary mt-2"
                style="background-color: #836FFF; color:white">Konfirmasi Pembelian</button>
    </div>
    </form>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Tentukan nilai awal untuk nomor urut sebagai 2
        let no = {{ old('books') ? count(old('books')) + 1 : 2 }};
        $("#add-select").on("click", function() {
            let el = `
                <div class="mt-3 row" id="books-${no}">
                    <div class = "row">
                    <label class="col-sm-3 col-form-label" for="books">Buku ${no} :</label>
                        <div class="col-sm-9" style="gap: 20px">
                                <div class="d-flex">
                                    <select name="books[]" id="books" class="form-select">
                                        <option disabled selected hidden>Pembelian ${no}</option>
                                        @foreach ($books as $index => $items)
                                        <option value=" {{ $items['id'] }} ">
                                            {{ $items['name'] }} = Rp.
                                            {{ number_format($items['price'], 2, ',', '.') }}</option>
                                            @endforeach
                                        </select>
                                        <div style="margin-left: 10px">
                                                <span class="btn btn-outline-danger" style="cursor: pointer; font-weight:bold; padding:10px; color:"
                                                    onclick="deleteSelect('books-${no}')"><i class="fa fa-times " aria-hidden="true"></i></span>
                                        </div>
                                </div>
                        </div>
                        </div>
                </div>`
            $("#wrap-books").append(el);
            no++;
        });

        function deleteSelect(elementId) {
            let elementIdForDelete = "#" + elementId;
            $(elementIdForDelete).remove();
            no--;
        }
    </script>
@endpush
