@extends('templates.app', ['title' => 'Data Peminjaman Buku'])

@section('dynamic-contents')
    <div class="container my-5" style="width: 75% ">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>History Pembelian</h1>
            </div>
            <div class="d-flex" style="gap: 20px">
                <form action="" class="d-flex" style="gap: 7px">
                    <input class="form-control border-primary col-1" type="date" placeholder="cari berdasarkan tanggal"
                        name="search" aria-label="Search">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"
                            aria-hidden="true"></i></button>
                    <button class="btn btn-secondary" type="submit">Clear</button>
                </form>
            </div>
            <div>
                <a class="btn " style="background-color: #836FFF; color:white"
                    href="{{ route('pelanggan.order.create') }}">+Pembelian</a>
            </div>
        </div>
        @if (Session::get('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2 " width="25" height="25" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                {{ Session::get('success') }}
            </div>
        @endif
        <div>
            <div class="card mb-4" style="box-shadow: 0px 1px 18px 1px rgb(195, 201, 250)">
                <table class="table table-striped table-borderless table-lebar m-auto">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Buku</th>
                            <th>Catatan Pembeli</th>
                            <th>Total harga</th>
                            <th>Tanggal Pembelian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($order) > 0)
                            @foreach ($order as $index => $item)
                                <tr>
                                    <td> {{ ($order->currentPage() - 1) * $order->perPage() + ($index + 1) }} </td>
                                    <td> {{ $item['name_customer'] }} </td>
                                    <td>
                                        @php
                                            $books = $item['books'];
                                            $bookDetails = [];
                                            foreach ($books as $book) {
                                                $bookDetails[] =
                                                    '👉 ' .
                                                    $book['name_book'] .
                                                    ' (Rp' .
                                                    number_format($book['sub_price'], 0, ',', '.') .
                                                    ') : ' .
                                                    'Rp' .
                                                    number_format($book['price'], 0, ',', '.') .
                                                    ' qty ' .
                                                    $book['qty'];
                                            }
                                            $booknames = implode('<br>', $bookDetails);
                                        @endphp
                                        {!! $booknames !!}
                                    </td>
                                    <td> {{ $item['notes'] }} </td>
                                    <td> Rp. {{ number_format($item['total_price'], 0, ',', '.') }} </td>
                                    <td> {{ Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %B %Y') }} </td>
                                    <td>
                                        <a href="{{ route('pelanggan.order.download', $item['id']) }} "
                                            class="btn btn-danger">Unduh PDF</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="8" class="text-bold text-danger">Data Pembelian anda Kosong</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $order->links() }}
            </div>
        @endsection
