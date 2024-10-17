@extends('templates.app', ['title' => 'Kelola akun'])

@section('dynamic-contents')
    <section class="container my-5" style="width: 75% ">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="text-center">Kelola Akun Pengguna</h1>
            <div class="d-flex" style="gap: 20px">
                <a href="{{ route('accounts.add') }} " class="btn btn-success">+ Tambah</a>
                <form class="d-flex" role="search" action=" {{ 'accounts' }} " method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search"
                    aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
        @if (Session::get('success'))
            <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert">
                <svg class="bi flex-shrink-0 me-2 " width="25" height="25" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::get('delete'))
            <div class="alert alert-warning d-flex align-items-center justify-content-center" role="alert">
                <svg class="bi flex-shrink-0 me-2 " width="25" height="25" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                {{ Session::get('delete') }}
            </div>
        @endif
        <div>
            <table class="table table-bordered table table-dark table-striped text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $index => $item)
                            <tr>
                                <td> {{ ($users->currentPage() - 1) * $users->perPage() + ($index + 1) }} </td>
                                <td> {{ $item['name'] }} </td>
                                <td> {{ $item['email'] }} </td>
                                <td> {{ $item['role'] }} </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('accounts.edit', ['id' => $item->id]) }}">Edit</a>
                                    <a class="btn btn-danger"
                                    onclick="showModal( '{{ $item->id }}', '{{ $item->email }}')">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-bold text-danger">Data Akun Pengguna Kosong</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" id="form-delete-accounts" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Akun Pengguna</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                apakah anda yakin akan menghapus data Akun <span id="nama-accounts"
                                    style="font-weight: bolder"></span> ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">Tetap Hapus</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="mt-2">
                {{ $users->links() }}
            </div>
            <div>
                <button class="btn btn-danger">📃Export ke PDF</button>
                <button class="btn btn-success">📃Export ke Excel</button>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModal(id, email) {
            let action = '{{ route('accounts.delete', ':id') }}';
            action = action.replace(':id', id);
            $('#form-delete-accounts').attr('action', action);
            $('#exampleModal').modal('show');
            console.log(email);
            $('#nama-accounts').text(email);
        }
    </script>
@endpush

