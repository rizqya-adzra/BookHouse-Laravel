@extends('templates.app', ['title' => 'Edit Data Buku'])

@section('dynamic-contents')
    <div class="card p-5 mt-5 md-5 m-auto" style="width: 50%">
        <h2 class="text-warning">Edit Data Buku</h2>
            <form action="{{ route('books.edit', $books['id']) }}" method="POST">
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
                @method('PATCH')

                <div class="row mt-4">
                    <div class="form-group col-md-6">
                        <label for="name" class="form-label" style="font-weight: bold">Judul Buku</label>
                        <input class="form-control border-warning" type="text" name="name" value=" {{ $books['name']}} ">
                        @error('name')
                            <small class="text-danger"> {{ $message }} </small>    
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="type" class=" form-label font-bold" style="font-weight: bold">Tipe Buku</label>
                        <select class="form-select border-warning" name="type" id="type">
                            <option hidden disabled selected value=""></option>
                            <option value="novel" {{ $books['type'] == 'novel' ? 'selected' : '' }}>Novel</option>
                            <option value="komik" {{ $books['type'] == 'komik' ? 'selected' : '' }}>Komik</option>
                            <option value="pendidikan" {{ $books['type'] == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        </select>
                        @error('type')
                            <small class="text-danger"> {{ $message }} </small>    
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mt-3 col-md-6">
                        <label for="author" class=" form-label font-bold" style="font-weight: bold">Penulis</label> 
                        <input class="form-control border-warning" type="text" id="author" name="author" value=" {{ $books['author'] }} ">
                        @error('author')
                            <small class="text-danger"> {{ $message }} </small>    
                        @enderror
                    </div>
                    <div class="form-group mt-3 col-md-6">
                        <label for="publisher" class=" form-label font-bold" style="font-weight: bold">Penerbit</label>
                        <input class="form-control border-warning" type="text" id="publisher" name="publisher" value=" {{ $books['publisher'] }} ">
                        @error('publisher')
                            <small class="text-danger"> {{ $message }} </small>    
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="publish" class=" form-label font-bold" style="font-weight: bold">Tahun Terbit</label>
                    <input class="form-control border-warning" type="text" id="publish" name="publish" value=" {{ $books['publish'] }} ">
                    @error('publish')
                            <small class="text-danger"> {{ $message }} </small>    
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="price" class=" form-label font-bold" style="font-weight: bold">Harga (IDR)</label>
                    <input class="form-control border-warning" type="text" id="price" name="price" value=" {{ $books['price'] }} ">
                    @error('price')
                            <small class="text-danger"> {{ $message }} </small>    
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="stock" class=" form-label font-bold" style="font-weight: bold">Stok Tersedia</label>
                    <input class="form-control border-warning" type="text" id="stock" name="stock" value=" {{ $books['stock'] }} ">
                    @error('stock')
                            <small class="text-danger"> {{ $message }} </small>    
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning mt-4">Kirim Data</button>
            </form>
    </div>
@endsection
