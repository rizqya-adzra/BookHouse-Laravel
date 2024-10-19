@extends('templates.app', ['title' => 'Tambah Data Buku'])

@section('dynamic-contents')
    <div class="card p-5 m-auto mt-5 mb-5" style="width: 50%">
        <h2 style="color: #836FFF">Tambah Data Buku</h2>
        <form class="" action="{{ route('books.add.store') }}" method="POST">
            @if (Session::get('failed'))
                <div class="alert alert-danger my-2"> {{ Session::get('failed') }} </div>
            @endif
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ol>
                </div>
            @endif --}}
            @csrf
            <div class="row mt-4">
                <div class="form-group col-md-6">
                    <label for="name" class="form-label" style="font-weight: bold">Judul Buku</label>
                    <input class="form-control warna" type="text" name="name" value=" {{ old('name') }} ">
                    @error('name')
                        <small class="text-danger"> {{ $message }} </small>    
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="type" class=" form-label font-bold" style="font-weight: bold">Tipe Buku</label>
                    <select class="form-select warna" name="type" id="type">
                        <option hidden disabled selected value=""></option>
                        <option value="novel" {{ old('type') == 'novel' ? 'selected' : '' }}>Novel</option>
                        <option value="komik" {{ old('type') == 'komik' ? 'selected' : '' }}>Komik</option>
                        <option value="pendidikan" {{ old('type') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    </select>
                    @error('type')
                        <small class="text-danger"> {{ $message }} </small>    
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group mt-3 col-md-6">
                    <label for="author" class=" form-label font-bold" style="font-weight: bold">Penulis</label> 
                    <input class="form-control warna" type="text" id="author" name="author" value=" {{ old('author') }} ">
                    @error('author')
                        <small class="text-danger"> {{ $message }} </small>    
                    @enderror
                </div>
                <div class="form-group mt-3 col-md-6">
                    <label for="publisher" class=" form-label font-bold" style="font-weight: bold">Penerbit</label>
                    <input class="form-control warna" type="text" id="publisher" name="publisher" value=" {{ old('publisher') }} ">
                    @error('publisher')
                        <small class="text-danger"> {{ $message }} </small>    
                    @enderror
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="publish" class=" form-label font-bold" style="font-weight: bold">Tahun Terbit</label>
                <input class="form-control warna" type="text" id="publish" name="publish" value=" {{ old('publish') }} ">
                @error('publish')
                        <small class="text-danger"> {{ $message }} </small>    
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="price" class=" form-label font-bold" style="font-weight: bold">Harga (IDR)</label>
                <input class="form-control warna" type="number" id="price" name="price" value=" {{ old('price') }} ">
                @error('price')
                        <small class="text-danger"> {{ $message }} </small>    
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="stock" class=" form-label font-bold" style="font-weight: bold">Stok Tersedia</label>
                <input class="form-control warna" type="number" id="stock" name="stock" value=" {{ old('stock') }} ">
                @error('stock')
                        <small class="text-danger"> {{ $message }} </small>    
                @enderror
            </div>
            <button type="submit" class="btn text-white mt-4" style="background-color: #836FFF">Kirim Data</button>
        </form>
    </div>
@endsection
