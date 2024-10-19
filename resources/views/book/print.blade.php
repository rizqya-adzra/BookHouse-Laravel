<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 style="text-align: center">Data Buku</h1>
    <table border="1">
        <thead>
            <tr style="text-align: center">
                <th>No</th>
                <th>Judul</th>
                <th>Tipe Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Harga</th>
                <th>Stok yang Tersedia</th>
            </tr>
        </thead>
        <tbody>
            @if (count($books) > 0)
                @foreach ($books as $index => $book)
                    <tr style="text-align: center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $book['name'] }}</td>
                        <td>{{ $book['type'] }}</td>
                        <td>{{ $book['author'] }}</td>
                        <td>{{ $book['publisher'] }}</td>
                        <td>{{ $book['publish'] }}</td>
                        <td>Rp. {{ number_format($book['price'], 0, ',', '.') }}</td>
                        <td class="{{ $book['stock'] <= 3 ? 'bg-danger text-white' : '' }}">
                            {{ $book['stock'] }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8">Data Buku Kosong</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>