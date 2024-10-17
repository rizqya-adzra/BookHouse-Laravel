@extends('templates.app', ['title' => 'Login Akun'])

@section('dynamic-contents')
    <div class="d-flex justify-content-center mt-5 m-auto" style="box-shadow: 1px 1px 20px 0px rgb(158, 164, 207); max-width: 800px">
        <div class="p-5 text-white" style=" background-color: #836FFF; max-width: 300px">
            <h1>Welcome! To <span class="text-warning">Qya's BookHouse</span></h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae ratione consequatur vero 
                reiciendis saepe fuga voluptatum consequuntur, ipsum iusto id dolor reprehenderit explicabo.</p>
        </div>
        <form class=" p-5" action="{{ route('login.auth') }}" method="POST" style="width: 700px">
            <h1 class="text-center mb-4">Login</h1>
            @csrf
            @if (Session::get('failed'))
                <div class="alert alert-danger"> {{ Session::get('failed') }} </div>
            @endif
            @if (Session::get('logout'))
                <div class="alert alert-info"> {{ Session::get('logout') }} </div>
            @endif
            @if (Session::get('canAccess'))
                <div class="alert alert-danger"> {{ Session::get('canAccess') }} </div>
            @endif
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="name" id="name" class="form-control">
                @error('name')
                    <small class="text-danger">Pastikan Nama anda benar! </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control">
                @error('email')
                    <small class="text-danger"> Pastikan Email anda benar! </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('email')
                    <small class="text-danger"> Pastikan Password anda benar! </small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Login</button>
        </form>
    </div>
@endsection
