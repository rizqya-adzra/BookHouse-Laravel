@extends('templates.app', ['title' => 'Tambah Data Buku'])

@section('dynamic-contents')
    <div class="m-auto" style="width: 50%">
        <h3 class="mt-4">Tambah Data Buku</h3>
        <form class="" action="{{ route('books.add.store') }}" method="POST">
            @if (Session::get('failed'))
                <div class="alert alert-danger my-2"> {{ Session::get('failed') }} </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ol>
                </div>
            @endif
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Judul Buku</label>
                <input class="form-control border-success-subtle" type="text" name="name" value=" {{ old('name') }} ">
            </div>
            <div class="form-group mt-3">
                <label for="type" class="form-label">Tipe Buku</label>
                <select class="form-select border-success-subtle" name="type" id="type">
                    <option hidden disabled selected value=""></option>
                    <option value="novel" {{ old('type') == 'novel' ? 'selected' : '' }}>Novel</option>
                    <option value="komik" {{ old('type') == 'komik' ? 'selected' : '' }}>Komik</option>
                    <option value="pendidikan" {{ old('type') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="author" class="form-label">Penulis</label>
                <input class="form-control border-success-subtle" type="text" id="author" name="author" value=" {{ old('author') }} ">
            </div>
            <div class="form-group mt-3">
                <label for="publisher" class="form-label">Penerbit</label>
                <input class="form-control border-success-subtle" type="text" id="publisher" name="publisher" value=" {{ old('publisher') }} ">
            </div>
            <div class="form-group mt-3">
                <label for="publish" class="form-label">Tahun Terbit</label>
                <input class="form-control border-success-subtle" type="text" id="publish" name="publish" value=" {{ old('publish') }} ">
            </div>
            <div class="form-group mt-3">
                <label for="price" class="form-label">Harga</label>
                <input class="form-control border-success-subtle" type="text" id="price" name="price" value=" {{ old('price') }} ">
            </div>
            <div class="form-group mt-3">
                <label for="stock" class="form-label">Stok Tersedia</label>
                <input class="form-control border-success-subtle" type="text" id="stock" name="stock" value=" {{ old('stock') }} ">
            </div>
            <button type="submit" class="btn btn-success mt-4">Kirim Data</button>
        </form>
    </div>
@endsection
