@extends('templates.app', ['title' => 'Tambah Data Pengguna'])

@section('dynamic-contents')
    <div class="card p-5 mt-5 mb-5 m-auto" style="width: 50%">
        <h2 class="text-success">Tambah Pengguna</h2>
        <form class="pt-4 mt-2" action="{{ route('accounts.add.store') }}" method="POST">
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
            <div class="form-group">
                <label for="name" class="form-label">Nama</label>
                <input class="form-control border-success-subtle" type="text" name="name" value=" {{ old('name') }} ">
                @error('name')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control border-success-subtle" type="email" id="email" name="email" value=" {{ old('email') }} ">
                @error('email')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="role" class="form-label">Tipe Akun</label>
                <select class="form-select border-success-subtle" name="role" id="role">
                    <option hidden disabled selected value=""></option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pelanggan" {{ old('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                </select>
                @error('role')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="password" class="form-label">Password</label>
                <input class="form-control border-success-subtle" type="password" id="password" name="password" value=" {{ old('password') }} ">
                @error('password')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <button type="submit" class="btn btn-success mt-4">Kirim Data</button>
        </form>
    </div>
@endsection
