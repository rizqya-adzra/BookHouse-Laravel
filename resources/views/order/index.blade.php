@extends('templates.app', ['title' => 'Data Peminjaman Buku'])

@section('dynamic-contents')
    <section class="container my-5" style="width: 75% ">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1>Data Buku</h1>
            <a href="{{ route('pelanggan.order.create') }} " class="btn btn-success">+ Tambah</a>
        </div>
        @if (Session::get('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">  
            <svg class="bi flex-shrink-0 me-2 " width="25" height="25" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            {{ Session::get('success') }} </div>
            @endif
        <div>
            <table class="table table-bordered table table-dark text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Buku</th>
                        <th>Tanggal Pembelian</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @if (count($order) > 0)
                        @foreach ($order as $index => $item)
                            <tr>
                                <td> {{ $index+1 }} </td>
                                <td> {{ $item['name_customer'] }} </td>
                                <td>
                                {{-- {{ $item['books'] }} --}}
                                </td>
                                <td> {{ $item['created_at'] }} </td>
                                <td>
                                    <a href="{{route('pelanggan.order.download', $item['id'])}} " class="btn btn-secondary">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-bold text-danger" href=" {{ route('') }} ">Data Pembelian anda Kosong</td>
                        </tr>
                    @endif
                </tbody>
            </table>
@endsection