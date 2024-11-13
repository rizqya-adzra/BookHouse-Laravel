@extends('templates.app', ['title' => 'Data pembelian'])

@section('dynamic-contents')
    <section class="container my-5" style="width: 75%">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>Data Pembelian</h1>
            </div>
            <div class="d-flex" style="gap: 20px">
                <form action="" class="d-flex" style="gap: 7px">
                    <input class="form-control border-success col-1" type="date" placeholder="cari berdasarkan tanggal"
                        name="search" aria-label="Search">
                    <button class="btn btn-success" type="submit"><i class="fa fa-search"
                            aria-hidden="true"></i></button>
                    <button class="btn btn-secondary" type="submit">Clear</button>
                </form>
            </div>
            <div>
                <a class="btn btn-success" href="{{ route('export-excel') }}">Export Excel</a>
            </div>
        </div>
        <div class="card mb-4" style="box-shadow: 0px 1px 18px 1px rgb(195, 201, 250)">
            <table class="table table-striped table-borderless table-lebar m-auto">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Pembeli</th>
                        <th>Akun</th>
                        <th>Buku</th>
                        <th>Catatan Pembeli</th>
                        <th>Tanggal Pembelian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orders) > 0)
                        
                    @foreach ($orders as $index => $order)
                    <tr>
                        <td> {{ ($orders->currentPage() - 1) * $orders->perPage() + ($index + 1) }} </td>
                        <td> {{ $order->name_customer }} </td>
                        <td> {{ $order['user']['email'] }} </td>
                        <td>
                            <ol>
                                @foreach ($order['books'] as $book)
                                <li>
                                    {{ $book['name_book'] }}
                                    ( Rp. {{ number_format($book['price'], 0, ',', '.') }}) :
                                    Rp. {{ number_format($book['sub_price'], 0, ',', '.') }}
                                    <small class="text-success">qty {{ $book['qty']}}</small>
                                </li>
                                @endforeach
                            </ol>
                        </td>
                        <td> {{ $order['notes']}} </td>
                        @php
                                setlocale(LC_ALL, 'IND')
                                @endphp
                            <td> {{ Carbon\Carbon::parse($order->created_at)->formatLocalized('%d %B %Y') }} </td>
                            <td> <a href=" {{ route('pelanggan.order.download', $order['id'])}} " class="btn btn-danger">Unduh PDF</a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="text-center">
                            <td colspan="8" class="text-bold text-danger">Data Pembelian Kosong</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $orders->links() }}
        </div>
    </section>
@endsection
