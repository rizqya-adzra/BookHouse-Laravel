<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembelian</title>
</head>

<body>
    <style>
        #back-wrap {
            margin: 30px auto 0 auto;
            width: 500px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-back {
            width: fit-content;
            padding: 8px 15px;
            color: #fff;
            background: #666;
            border-radius: 5px;
            text-decoration: none;
        }

        #receipt {
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 30px auto 0 auto;
            width: 500px;
            background: #FFF;
        }

        h2 {
            font-size: .9rem;
        }

        p {
            font-size: .8rem;
            color: #666;
            line-height: 1.2rem;
        }

        #top {
            margin-top: 25px;
        }

        #top .info {
            text-align: left;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE;
        }

        .tabletitle {
            font-size: 5rem;
            background: #EEE;
        }

        .service {
            border-bottom: 1px solid #EEE;
        }

        .itemtext {
            font-size: .7rem;
        }

        #legalcopy {
            margin-top: 15px;
        }

        .btn-print {
            float: right;
            color: #333;
        }
    </style>
    <div id="receipt">
        <center id="top">
            <div class="info">
                <h2>
                    Buku Qya Jaya Jaya Jaya
                </h2>
            </div>
        </center>
        <div id="mid">
            <p>
                Alamat: Depok <br>
                Email: JayaQya@gmail.com <br>
                Phone: 1234-5678-9101 <br>
            </p>
        </div>
        <div id="bot">
            <div id="table">
                <table>
                    <tr>
                        <td class="item">
                            <h2>Buku</h2>
                        </td>
                        <td class="item">
                            <h2>Total</h2>
                        </td>
                        <td class="item">
                            <h2>Harga</h2>
                        </td>
                    </tr>
                    @foreach ($order['books'] as $books)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext"> {{ $books['name_book'] }} </p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext"> {{ $books['qty'] }} </p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext"> Rp.{{ number_format($books['price'], 0, ',', '.') }} </p>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="tabletitle">
                        <td></td>
                        <td class="rate">
                            <h2>PPN (10%)</h2>
                        </td>
                        @php
                            $ppn = $order['total_price'] * 0.01;
                        @endphp
                        <td class="payment">
                            <h2>Rp. {{ number_format($ppn, 0, ',', '.') }} </h2>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="rate">
                            <h2>Total Harga:</h2>
                        </td>
                        <td class="payment">
                            <h2>Rp. {{ number_format($order['total_price'], 0, ',', '.') }} </h2>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="legalcopy">
                <p class="legal"><strong>Terima Kasih atas pembelian anda!</strong> Lorem ipsum dolor sit
                    amet consectetur adipisicing elit. Provident sequi quos quidem praesentium cumque ipsum fugit velit.
                    Explicabo,
                    dolor. Unde asperiores quibusdam, necessitatibus aperiam hic voluptatibus ipsa officiis quo itaque?
                </p>
            </div>
        </div>
    </div>
</body>

</html>


