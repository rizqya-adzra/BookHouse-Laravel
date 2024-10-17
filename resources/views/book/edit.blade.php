@extends('templates.app', ['title' => 'Edit Data Buku'])

@section('dynamic-contents')
    <div class="m-auto" style="width: 50%">
        <h3 class="mt-4">Edit Data Buku</h3>
            <form action="{{ route('books.edit', $books['id']) }}" method="POST">
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
                @method('PATCH')

                <div class="form-group">
                    <label for="name" class="form-label">Judul Buku</label>
                    <input class="form-control border-warning-subtle" type="text" name="name" value=" {{ $books['name'] }} ">
                </div>
                <div class="form-group mt-3">
                    <label for="type" class="form-label">Tipe Buku</label>
                    <select class="form-select border-warning-subtle" name="type" id="type">
                        <option hidden disabled selected value=""></option>
                        <option value="novel" {{ $books['type'] == 'novel' ? 'selected' : '' }}>Novel</option>
                        <option value="komik" {{ $books['type'] == 'komik' ? 'selected' : '' }}>Komik</option>
                        <option value="pendidikan" {{ $books['type'] == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="author" class="form-label">Penulis</label>
                    <input class="form-control border-warning-subtle" type="text" id="author" name="author"
                        value=" {{ $books['author'] }} ">
                </div>
                <div class="form-group mt-3">
                    <label for="publisher" class="form-label">Penerbit</label>
                    <input class="form-control border-warning-subtle" type="text" id="publisher" name="publisher"
                        value=" {{ $books['publisher'] }} ">
                </div>
                <div class="form-group mt-3">
                    <label for="publish" class="form-label">Tahun Terbit</label>
                    <input class="form-control border-warning-subtle" type="text" id="publish" name="publish"
                        value=" {{ $books['publish'] }} ">
                </div>
                <div class="form-group mt-3">
                    <label for="price" class="form-label">Harga</label>
                    <input class="form-control border-warning-subtle" type="text" id="price" name="price"
                        value=" {{ $books['price'] }} ">
                </div>
                <div class="form-group mt-3">
                    <label for="stock" class="form-label">Stok Tersedia</label>
                    <input class="form-control border-warning-subtle" type="text" id="stock" name="stock"
                        value=" {{ $books['stock'] }} ">
                </div>
                <button type="submit" class="btn btn-warning mt-4">Kirim Data</button>
            </form>
    </div>
@endsection
