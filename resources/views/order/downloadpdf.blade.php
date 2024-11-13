<html lang="en">
    <!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
    
        #back-wrap {
            margin: auto;
            width: 100%;
            max-width: 500px;
        }
    
        .btn-back {
            padding: 8px 15px;
            color: #fff;
            background: #3498db;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s;
        }
    
        .btn-back:hover {
            background: #2980b9;
        }
    
        #receipt {
            background-color: #ffffff;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            max-width: 550px;
            padding: 20px;
            margin: auto;
            margin-top: 30px;
            margin-bottom: 30px;
        }
    
        h2 {
            font-size: 1.4rem;
            color: #2c3e50;
            margin-bottom: 5px;
        }
    
        p {
            font-size: 1rem;
            color: #444;
            line-height: 1.6;
        }
    
        #top {
            text-align: center;
            margin-bottom: 20px;
        }
    
        #top h2 {
            color: #34495e;
            margin-bottom: 10px;
            font-weight: 600;
        }
    
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
    
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
    
        th {
            font-size: 0.95rem;
            color: #555;
            font-weight: 600;
        }
    
        .tabletitle h2 {
            font-size: 1rem;
            color: #333;
            font-weight: 600;
        }
    
        .service {
            font-size: 1rem;
        }
    
        .itemtext {
            font-size: 0.95rem;
            color: #333;
        }
    
        .btn-print {
            color: #3498db;
            font-size: 0.9rem;
            text-decoration: none;
        }
    
        .btn-print:hover {
            color: #2980b9;
        }
    
        #legalcopy {
            margin-top: 30px;
            text-align: center;
        }
    
        .legal {
            font-size: 0.85rem;
            color: #666;
        }
    
        /* Tambahan gaya untuk garis tepi */
        .border-top {
            border-top: 2px solid #ddd;
            margin-top: 10px;
        }
    
        /* Tambahan gaya untuk total harga */
        .total-row h2 {
            font-size: 1.1rem;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="receipt">
        <center id="top">
            <div class="info">
                <h2>Buku Qya Jaya Jaya Jaya</h2>
                <p>Alamat: Depok <br> Email: JayaQya@gmail.com <br> Phone: 1234-5678-9101</p>
            </div>
        </center>
        <div id="mid">
            <p>Nama Pembeli: <b>{{ $order['name_customer'] }}</b></p>
        </div>
        <div id="bot">
            <table>
                <tr>
                    <th>Judul Buku</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                </tr>
                @foreach ($order['books'] as $book)
                <tr class="service">
                    <td class="tableitem"><p class="itemtext"> {{ $book['name_book'] }} </p></td>
                    <td class="tableitem"><p class="itemtext"> {{ $book['qty'] }} </p></td>
                    <td class="tableitem"><p class="itemtext"> Rp. {{ number_format($book['price'], 0, ',', '.') }} </p></td>
                </tr>
                @endforeach
                <tr class="tabletitle">
                    <td></td>
                    <td><h2>PPN (10%)</h2></td>
                    @php
                        $ppn = $order['total_price'] * 0.1;
                        @endphp
                    <td><h2>Rp. {{ number_format($ppn, 0, ',', '.') }} </h2></td>
                </tr>
                <tr class="tabletitle">
                    <td></td>
                    <td><h2>Total Harga:</h2></td>
                    <td><h2>Rp. {{ number_format($order['total_price'], 0 , ',', '.')}} </h2></td>
                </tr>
            </table>
            <div id="legalcopy">
                <p class="legal"><strong>Terima Kasih atas pembelian Anda!</strong> Kami senang melayani Anda. Hubungi kami jika ada pertanyaan.</p>
            </div>
        </div>
    </div>
    {{-- <div id="back-wrap">
        <a href="{{ route('pelanggan.order.index') }}" class="btn-back">Kembali</a>
        <a href="{{ route('pelanggan.order.download', $order['id']) }}" class="btn-download">Cetak (.pdf)</a>
    </div> --}}
</body>

</html>