@extends('templates.app', ['title' => 'Data Peminjaman Buku'])

@section('dynamic-contents')
    <section class="container my-5" style="width: 75% ">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1>Data Buku</h1>
            <div class="d-flex" style="gap: 20px">
                <a href="{{ route('books.add') }} " class="btn" style="background-color: #836FFF; color:white">+ Tambah</a>
                <form class="d-flex" role="search" action=" {{ 'books' }} " method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search"
                    aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
        @if (Session::get('success'))
        <div class="alert alert-success d-flex align-items-center justify-content-center">  
            <svg class="bi flex-shrink-0 me-2 " width="25" height="25" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            {{ Session::get('success') }} </div>
            @endif
        <div class="card mb-4" style="box-shadow: 0px 1px 0px 1px rgb(195, 201, 250)">
            <table class="table table-striped text-center table-borderless table-lebar m-auto">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tipe Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Harga</th>
                        <th>Stok yang Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($books) > 0)
                        @foreach ($books as $index => $item)
                            <tr>
                                <td> {{ ($books->currentPage() - 1) * $books->perPage() + ($index + 1) }} </td>
                                <td> {{ $item['name'] }} </td>
                                <td> {{ $item['type'] }} </td>
                                <td> {{ $item['author'] }} </td>
                                <td> {{ $item['publisher'] }} </td>
                                <td> {{ $item['publish'] }} </td>
                                <td> Rp. {{ number_format($item['price'], 0, ',', '.') }} </td>
                                <td class=" {{ $item['stock'] <= 3 ? 'table-danger' : '' }}"> {{ $item['stock'] }} </td>
                                    <td>
                                        <a href="{{ route('books.edit', ['id' => $item->id]) }} "
                                            class="btn btn-warning"><i class="fa fa-pencil fa-1x" aria-hidden="true"></i></a>
                                            <a class="btn btn-danger"
                                            onclick="showModal( '{{ $item->id }}', '{{ $item->name }}')"><i class="fa fa-trash fa-1x" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8" class="text-bold text-danger">Data Buku Kosong</td>
                                    </tr>
                                    @endif 
                                </tbody>
                            </table>
                        </div>
            <div class="d-flex justify-content-between">
                <div class="mt-2">
                    {{ $books->links() }}
                </div>
                <div>
                    <a class="btn btn-danger text-white" href=" {{ url('/books/download') }} ">📃Export ke PDF</a>
                    {{-- <button class="btn btn-success">📃Export ke Excel</button> --}}
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" id="form-delete-buku" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus data Buku</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                apakah anda yakin akan menghapus data Buku <span id="nama-buku"
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
    </section>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModal(id, name) {
            let action = '{{ route('books.delete', ':id') }}';
            action = action.replace(':id', id);
            $('#form-delete-buku').attr('action', action);
            $('#exampleModal').modal('show');
            console.log(name);
            $('#nama-buku').text(name);
        }
    </script>
@endpush
