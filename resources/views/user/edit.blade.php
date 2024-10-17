@extends('templates.app', ['title' => 'Edit Akun Pengguna'])

@section('dynamic-contents')
    <div class="m-auto" style="width: 50%">
        <h3 class="mt-5">Edit Akun Pengguna</h3>
            <form class="pt-4 mt-2 " action="{{ route('accounts.edit', $users['id']) }}" method="POST">
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
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control border-warning-subtle" type="text" name="name" value=" {{ $users['name'] }} ">
                </div>
                <div class="form-group mt-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control border-warning-subtle" type="email" id="email" name="email" value=" {{ $users['email'] }} ">
                </div>
                <div class="form-group mt-3">
                    <label for="role" class="form-label">Tipe Akun</label>
                    <select class="form-select border-warning-subtle" name="role" id="role">
                        <option hidden disabled selected value=""></option>
                        <option value="admin" {{ $users['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pelanggan" {{ $users['role'] == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="form-label">Ubah Password</label>
                    <input class="form-control border-warning-subtle" type="text" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-warning mt-4">Kirim Data</button>
            </form>
    </div>
@endsection