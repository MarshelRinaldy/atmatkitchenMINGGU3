<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atma Kitchen</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
            background-image: url('../assets/images/bgcake2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen",
                "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue",
                sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            user-select: none;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8);
            /* Ubah nilai alpha (0.8) sesuai kebutuhan */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-around;
            background-color: rgba(248, 248, 248, 0.8);
            /* Ubah nilai alpha (0.8) sesuai kebutuhan */
            padding: 10px;
            border-bottom: 1px solid #ddd;
            border-radius: 10px;
        }

        .navbar a {
            color: #333;
            text-decoration: none;
            padding: 10px;
            transition: color 0.3s;
        }

        .navbar a:hover {
            color: #ff5722;
        }

        .navbar a.active {
            color: #ff5722;
            border-bottom: 2px solid #ff5722;
        }

        .cart {
            width: 100%;
        }

        .cart-header,
        .cart-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .cart-header {
            background-color: #ff9d2e;
            font-weight: bold;
        }

        .cart-item,
        .cart-price,
        .cart-quantity,
        .cart-total,
        .cart-actions {
            flex: 1;
            text-align: center;
        }

        .cart-item {
            display: flex;
            align-items: center;
        }

        .cart-item img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .cart-quantity form {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-quantity input[type="number"] {
            width: 60px;
            padding: 5px;
            margin-right: 10px;
        }

        .cart-actions form {
            display: inline;
        }

        .cart-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 50px 0px 50px;
            border-top: 1px solid #e0e0e0;
            margin-top: 20px;
        }

        .cart-summary {
            font-size: 1.2em;
            font-weight: bold;
        }

        .checkout-button {
            padding: 10px 20px;
            background-color: #ff9d2e;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }

        .checkout-button:hover {
            background-color: #ff9d2e;
        }

        .transaksi {
            padding-top: 20px;
            border: 1px solid rgba(224, 224, 224, 0.7);
            /* Ubah nilai alpha (0.5) sesuai kebutuhan */
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.7);
            /* Ubah nilai alpha (0.8) sesuai kebutuhan */
        }


        .transaction-date {
            float: right;
            font-size: 14px;
            color: #888;
        }

        .custom-img-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            flex-wrap: wrap;
        }

        .custom-img-item {
            text-align: center;
            margin-left: 10px;
        }

        .custom-img-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .custom-img-item div {
            font-size: 0.9em;
            color: #555;
            margin-top: 5px;
        }

        .extra-images {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #e0e0e0;
            width: 100px;
            height: 100px;
            margin-left: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .btn-custom {
            width: 200px;
            height: 50px;
            background-color: #ff9d2e;
            color: white
        }

        .btn-custom:hover {
            background-color: #000000;
            color: white
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="navbar">

            <a href="#" class="tab-link" data-tab="belum-bayar">Belum Bayar</a>
            <a href="#" class="tab-link" data-tab="konfirmasi-pembayaran">Diproses</a>
            <a href="#" class="tab-link" data-tab="pembuatan-po">Proses Pembuatan PO</a>
            <a href="#" class="tab-link" data-tab="diproses">Sedang Dikemas</a>
            <a href="#" class="tab-link" data-tab="dikirim">Dikirim/Dipickup</a>
            <a href="#" class="tab-link" data-tab="selesai">Selesai</a>
            <a href="#" class="tab-link" data-tab="dibatalkan">Dibatalkan</a>
        </div>


        <div id="belum-bayar" class="tab-content">
            <h2 class="card-title mb-5">Produk yang siap dibayar</h2>
            @foreach ($transaksis as $transaksi)
                @if ($transaksi->status_transaksi == 'menunggu pembayaran')
                    <div class="row">
                        <div class="col-12">
                            <div class="transaksi">
                                <h5 class="card-title ml-5">No Transaksi : {{ $transaksi->no_transaksi }}</h5>
                                <hr>
                                <div class="row mr-5">
                                    @foreach ($transaksi->detailTransaksis as $detail)
                                        <div class="col-10 mb-5">
                                            <div class="row">
                                                <div class="col-3">
                                                    @if ($detail->is_hampers)
                                                        <img src="{{ asset('../storage/hampers/' . $detail->hampers->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @else
                                                        <img src="{{ asset('../storage/dukpro/' . $detail->produk->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    @if ($detail->is_hampers)
                                                        <h2>{{ $detail->hampers->nama }}</h2>
                                                    @else
                                                        <h2>{{ $detail->produk->nama }}</h2>
                                                    @endif

                                                    @if ($detail->is_hampers)
                                                        <h5>{{ truncateDescription($detail->hampers->deskripsi) }}</h5>
                                                    @else
                                                        <h5>{{ truncateDescription($detail->produk->deskripsi) }}</h5>
                                                    @endif

                                                    <p>Quantity : {{ $detail->jumlah_produk }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-5 d-flex justify-content-end">
                                            @if ($detail->is_hampers)
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->hampers->harga }},00</p>
                                            @else
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->produk->harga }},00</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-9"></div>
                                    <div class="col-3">
                                        <h5>Biaya Ongkir : {{ $transaksi->biaya_ongkir }}</h5>
                                        <h4 style="font-weight: 600">Total : {{ $transaksi->total_harga }}</h4>
                                    </div>
                                </div>
                                <!-- Add the payment button here -->
                                <div class="row mt-4">
                                    <div class="col-12 d-flex justify-content-center">
                                        <a href="{{ route('payment_pesanan', ['id' => $transaksi->id]) }}"
                                            class="btn btn-primary mb-3">Payment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        @php
            function truncateDescription($description, $limit = 100)
            {
                if (strlen($description) > $limit) {
                    return substr($description, 0, $limit) . '...';
                }
                return $description;
            }
        @endphp


        <div id="konfirmasi-pembayaran" class="tab-content">
            <h1 class="card-title text-center mb-5 mt-2">Menunggu Konfirmasi Pembayaran</h1>
            @foreach ($transaksis as $transaksi)
                @if (in_array($transaksi->status_transaksi, ['menunggu konfirmasi', 'menunggu konfirmasi mo']))
                    <div class="row">
                        <div class="col-12">
                            <div class="transaksi">
                                <h5 class="card-title ml-5">No Transaksi : {{ $transaksi->no_transaksi }}</h5>
                                <hr>
                                <div class="row mr-5">
                                    @foreach ($transaksi->detailTransaksis as $detail)
                                        <div class="col-10 mb-5">
                                            <div class="row">
                                                <div class="col-3">
                                                    @if ($detail->is_hampers)
                                                        <img src="{{ asset('../storage/hampers/' . $detail->hampers->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @else
                                                        <img src="{{ asset('../storage/dukpro/' . $detail->produk->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @endif

                                                </div>
                                                <div class="col-6">
                                                    @if ($detail->is_hampers)
                                                        <h2>{{ $detail->hampers->nama }}</h2>
                                                    @else
                                                        <h2>{{ $detail->produk->nama }}</h2>
                                                    @endif

                                                    @if ($detail->is_hampers)
                                                        <h5>{{ truncateDescription($detail->hampers->deskripsi) }}</h5>
                                                    @else
                                                        <h5>{{ truncateDescription($detail->produk->deskripsi) }}</h5>
                                                    @endif

                                                    <p>Quantity : {{ $detail->jumlah_produk }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-5 d-flex justify-content-end">
                                            @if ($detail->is_hampers)
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->hampers->harga }},00</p>
                                            @else
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->produk->harga }},00</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-9"></div>
                                    <div class="col-3">
                                        <h5>Biaya Ongkir : {{ $transaksi->biaya_ongkir }}</h5>
                                        <h4 style="font-weight: 600">Total : {{ $transaksi->total_harga }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div id="konfirmasi-pembayaran" class="tab-content">
            <h1 class="card-title text-center mb-5 mt-2">Menunggu Pemrosesan Pre Order</h1>
            @foreach ($transaksis as $transaksi)
                @if ($transaksi->status_transaksi == 'menunggu pemrosesan pesanan')
                    <div class="row">
                        <div class="col-12">
                            <div class="transaksi">
                                <h5 class="card-title ml-5">No Transaksi : {{ $transaksi->no_transaksi }}</h5>
                                <hr>
                                <div class="row mr-5">
                                    @foreach ($transaksi->detailTransaksis as $detail)
                                        <div class="col-10 mb-5">
                                            <div class="row">
                                                <div class="col-3">
                                                    @if ($detail->is_hampers)
                                                        <img src="{{ asset('../storage/hampers/' . $detail->hampers->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @else
                                                        <img src="{{ asset('../storage/dukpro/' . $detail->produk->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @endif

                                                </div>
                                                <div class="col-6">
                                                    @if ($detail->is_hampers)
                                                        <h2>{{ $detail->hampers->nama }}</h2>
                                                    @else
                                                        <h2>{{ $detail->produk->nama }}</h2>
                                                    @endif

                                                    @if ($detail->is_hampers)
                                                        <h5>{{ truncateDescription($detail->hampers->deskripsi) }}</h5>
                                                    @else
                                                        <h5>{{ truncateDescription($detail->produk->deskripsi) }}</h5>
                                                    @endif

                                                    <p>Quantity : {{ $detail->jumlah_produk }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-5 d-flex justify-content-end">
                                            @if ($detail->is_hampers)
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->hampers->harga }},00</p>
                                            @else
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->produk->harga }},00</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-9"></div>
                                    <div class="col-3">
                                        <h5>Biaya Ongkir : {{ $transaksi->biaya_ongkir }}</h5>
                                        <h4 style="font-weight: 600">Total : {{ $transaksi->total_harga }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div id="diproses" class="tab-content">
            <h1 class="card-title text-center mb-5 mt-2">Produk yang sedang dikemas</h1>
            @foreach ($transaksis as $transaksi)
                @if ($transaksi->status_transaksi == 'sedang dikemas')
                    <div class="row">
                        <div class="col-12">
                            <div class="transaksi">
                                <h5 class="card-title ml-5">No Transaksi : {{ $transaksi->no_transaksi }}</h5>
                                <hr>
                                <div class="row mr-5">
                                    @foreach ($transaksi->detailTransaksis as $detail)
                                        <div class="col-10 mb-5">
                                            <div class="row">
                                                <div class="col-3">
                                                    @if ($detail->is_hampers)
                                                        <img src="{{ asset('../storage/hampers/' . $detail->hampers->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @else
                                                        <img src="{{ asset('../storage/dukpro/' . $detail->produk->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @endif

                                                </div>
                                                <div class="col-6">
                                                    @if ($detail->is_hampers)
                                                        <h2>{{ $detail->hampers->nama }}</h2>
                                                    @else
                                                        <h2>{{ $detail->produk->nama }}</h2>
                                                    @endif

                                                    @if ($detail->is_hampers)
                                                        <h5>{{ truncateDescription($detail->hampers->deskripsi) }}</h5>
                                                    @else
                                                        <h5>{{ truncateDescription($detail->produk->deskripsi) }}</h5>
                                                    @endif

                                                    <p>Quantity : {{ $detail->jumlah_produk }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-5 d-flex justify-content-end">
                                            @if ($detail->is_hampers)
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->hampers->harga }},00</p>
                                            @else
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->produk->harga }},00</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-9"></div>
                                    <div class="col-3">
                                        <h5>Biaya Ongkir : {{ $transaksi->biaya_ongkir }}</h5>
                                        <h4 style="font-weight: 600">Total : {{ $transaksi->total_harga }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{-- <div id="diproses" class="tab-content">
            <h2 class="card-title mb-5">Produk yang sedang dikemas</h2>
            @foreach ($transaksis as $transaksi)
                @if ($transaksi->status_transaksi == 'sedang dikemas')
                    <div class="transaksi">
                        <div class="card-body">
                            <h5 class="card-title">No Pesanan : {{ $transaksi->no_transaksi }}</h5>
                            <div class="custom-img-container">
                                @foreach ($transaksi->detailTransaksis as $detail)
                                    <div class="custom-img-item">
                                        <img src="{{ asset('../storage/dukpro/' . $detail->produk->image) }}"
                                            alt="{{ $detail->produk->nama }}" class="img-fluid">
                                        <div>{{ $detail->produk->nama }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                <span class="card-text"><strong>Total:
                                        Rp{{ number_format($transaksi->total_harga, 2, ',', '.') }}</strong></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span
                                class="transaction-date">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div> --}}


        <div id="dikirim" class="tab-content">
            <h1 class="card-title text-center mb-5 mt-2">Produk yang sedang dikirim / Sudah bisa di pickup</h1>
            @foreach ($transaksis as $transaksi)
                @if ($transaksi->status_transaksi == 'sudah dikonfirmasi')
                    <div class="row">
                        <div class="col-12">
                            <div class="transaksi">
                                <h5 class="card-title ml-5">No Transaksi : {{ $transaksi->no_transaksi }}</h5>
                                <hr>
                                <div class="row mr-5">
                                    @foreach ($transaksi->detailTransaksis as $detail)
                                        <div class="col-10 mb-5">
                                            <div class="row">
                                                <div class="col-3">
                                                    @if ($detail->is_hampers)
                                                        <img src="{{ asset('../storage/hampers/' . $detail->hampers->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @else
                                                        <img src="{{ asset('../storage/dukpro/' . $detail->produk->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @endif

                                                </div>
                                                <div class="col-6">
                                                    @if ($detail->is_hampers)
                                                        <h2>{{ $detail->hampers->nama }}</h2>
                                                    @else
                                                        <h2>{{ $detail->produk->nama }}</h2>
                                                    @endif

                                                    @if ($detail->is_hampers)
                                                        <h5>{{ truncateDescription($detail->hampers->deskripsi) }}</h5>
                                                    @else
                                                        <h5>{{ truncateDescription($detail->produk->deskripsi) }}</h5>
                                                    @endif

                                                    <p>Quantity : {{ $detail->jumlah_produk }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-5 d-flex justify-content-end">
                                            @if ($detail->is_hampers)
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->hampers->harga }},00</p>
                                            @else
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->produk->harga }},00</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-9"></div>
                                    <div class="col-3">
                                        <h5>Biaya Ongkir : {{ $transaksi->biaya_ongkir }}</h5>
                                        <h4 style="font-weight: 600">Total : {{ $transaksi->total_harga }}</h4>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button id="selesai-button-{{ $transaksi->id }}"
                                        class="btn btn-custom btn-sm selesai-button"
                                        data-id="{{ $transaksi->id }}">Selesai</button>
                                    <span
                                        class="transaction-date">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>


        {{-- <div id="dikirim" class="tab-content">
            <h2 class="card-title mb-5">Produk yang sedang dikirim / Sudah bisa di pickup</h2>
            @foreach ($transaksis as $transaksi)
                @if ($transaksi->status_transaksi == 'sudah dikonfirmasi')
                    <div class="transaksi">
                        <div class="card-body">
                            <h5 class="card-title">No Pesanan : {{ $transaksi->no_transaksi }}</h5>
                            <div class="custom-img-container">
                                @foreach ($transaksi->detailTransaksis as $detail)
                                    <div class="custom-img-item">
                                        <img src="../image/{{ $detail->produk->image }}"
                                            alt="{{ $detail->produk->nama }}" class="img-fluid">
                                        <div>{{ $detail->produk->nama }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                <span class="card-text"><strong>Total:
                                        Rp{{ number_format($transaksi->total_harga, 2, ',', '.') }}</strong></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="selesai-button-{{ $transaksi->id }}"
                                class="btn btn-primary btn-sm selesai-button"
                                data-id="{{ $transaksi->id }}">Selesai</button>
                            <span
                                class="transaction-date">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div> --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.selesai-button').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var transaksiId = this.getAttribute('data-id');
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Do you want to mark this transaction as complete?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, complete it!',
                            cancelButtonText: 'No, cancel!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Create and submit the form with PATCH method
                                var form = document.createElement('form');
                                form.method = 'POST';
                                form.action = '{{ route('pesanan_selesai', ['id' => ':id']) }}'
                                    .replace(':id', transaksiId);

                                // Add hidden input for PATCH method
                                var inputMethod = document.createElement('input');
                                inputMethod.type = 'hidden';
                                inputMethod.name = '_method';
                                inputMethod.value = 'PATCH';
                                form.appendChild(inputMethod);

                                // CSRF token
                                var csrfToken = document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content');
                                var inputToken = document.createElement('input');
                                inputToken.type = 'hidden';
                                inputToken.name = '_token';
                                inputToken.value = csrfToken;
                                form.appendChild(inputToken);

                                document.body.appendChild(form);
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div id="selesai" class="tab-content">
            <h2 class="card-title mb-5">Produk yang selesai</h2>
            @foreach ($transaksis as $transaksi)
                @if ($transaksi->status_transaksi == 'selesai')
                    <div class="row">
                        <div class="col-12">
                            <div class="transaksi">
                                <h5 class="card-title ml-5">No Transaksi : {{ $transaksi->no_transaksi }}</h5>
                                <hr>
                                <div class="row mr-5">
                                    @foreach ($transaksi->detailTransaksis as $detail)
                                        <div class="col-10 mb-5">
                                            <div class="row">
                                                <div class="col-3">
                                                    @if ($detail->is_hampers)
                                                        <img src="{{ asset('../storage/hampers/' . $detail->hampers->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @else
                                                        <img src="{{ asset('../storage/dukpro/' . $detail->produk->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @endif

                                                </div>
                                                <div class="col-6">
                                                    @if ($detail->is_hampers)
                                                        <h2>{{ $detail->hampers->nama }}</h2>
                                                    @else
                                                        <h2>{{ $detail->produk->nama }}</h2>
                                                    @endif

                                                    @if ($detail->is_hampers)
                                                        <h5>{{ truncateDescription($detail->hampers->deskripsi) }}</h5>
                                                    @else
                                                        <h5>{{ truncateDescription($detail->produk->deskripsi) }}</h5>
                                                    @endif

                                                    <p>Quantity : {{ $detail->jumlah_produk }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-5 d-flex justify-content-end">
                                            @if ($detail->is_hampers)
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->hampers->harga }},00</p>
                                            @else
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->produk->harga }},00</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-9"></div>
                                    <div class="col-3">
                                        <h5>Biaya Ongkir : {{ $transaksi->biaya_ongkir }}</h5>
                                        <h4 style="font-weight: 600">Total : {{ $transaksi->total_harga }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>


        <div id="dibatalkan" class="tab-content">
            <h1 class="card-title text-center mb-5 mt-2">Produk yang dibatalkan</h1>
            @foreach ($transaksis as $transaksi)
                @if ($transaksi->status_transaksi == 'Dibatalkan')
                    <div class="row">
                        <div class="col-12">
                            <div class="transaksi">
                                <h5 class="card-title ml-5">No Transaksi : {{ $transaksi->no_transaksi }}</h5>
                                <hr>
                                <div class="row mr-5">
                                    @foreach ($transaksi->detailTransaksis as $detail)
                                        <div class="col-10 mb-5">
                                            <div class="row">
                                                <div class="col-3">
                                                    @if ($detail->is_hampers)
                                                        <img src="{{ asset('../storage/hampers/' . $detail->hampers->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @else
                                                        <img src="{{ asset('../storage/dukpro/' . $detail->produk->image) }}"
                                                            alt="{{ $detail->produk->nama }}" class="img-fluid ml-5"
                                                            width="150px;">
                                                    @endif

                                                </div>
                                                <div class="col-6">
                                                    @if ($detail->is_hampers)
                                                        <h2>{{ $detail->hampers->nama }}</h2>
                                                    @else
                                                        <h2>{{ $detail->produk->nama }}</h2>
                                                    @endif

                                                    @if ($detail->is_hampers)
                                                        <h5>{{ truncateDescription($detail->hampers->deskripsi) }}</h5>
                                                    @else
                                                        <h5>{{ truncateDescription($detail->produk->deskripsi) }}</h5>
                                                    @endif

                                                    <p>Quantity : {{ $detail->jumlah_produk }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-5 d-flex justify-content-end">
                                            @if ($detail->is_hampers)
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->hampers->harga }},00</p>
                                            @else
                                                <p style="font-size: 20px; font-weight: 600;">Rp.
                                                    {{ $detail->produk->harga }},00</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-9"></div>
                                    <div class="col-3">
                                        <h5>Biaya Ongkir : {{ $transaksi->biaya_ongkir }}</h5>
                                        <h4 style="font-weight: 600">Total : {{ $transaksi->total_harga }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{--
        <div id="dibatalkan" class="tab-content">
            <h2 class="card-title mb-5">Produk yang dibatalkan</h2>
            @foreach ($transaksis as $transaksi)
                @if ($transaksi->status_transaksi == 'Dibatalkan')
                    <div class="transaksi">
                        <div class="card-body">
                            <h5 class="card-title">Transaksi {{ $loop->iteration }}</h5>
                            <div class="custom-img-container">
                                @foreach ($transaksi->detailTransaksis as $detail)
                                    <div class="custom-img-item">
                                        <img src="{{ $detail->produk->image }}" alt="{{ $detail->produk->nama }}"
                                            class="img-fluid">
                                        <div>{{ $detail->produk->nama }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                <span class="card-text"><strong>Total:
                                        Rp{{ number_format($transaksi->total_harga, 2, ',', '.') }}</strong></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('payment_pesanan', $transaksi->id) }}" method="GET">
                                <button class="btn btn-primary btn-sm">Payment</button>
                            </form>
                            <span
                                class="transaction-date">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div> --}}



        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabLinks = document.querySelectorAll('.tab-link');
                const tabContents = document.querySelectorAll('.tab-content');

                tabLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();

                        tabLinks.forEach(link => link.classList.remove('active'));
                        tabContents.forEach(content => content.classList.remove('active'));

                        this.classList.add('active');
                        const tab = this.getAttribute('data-tab');
                        document.getElementById(tab).classList.add('active');
                    });
                });

                const containers = document.querySelectorAll('.custom-img-container');

                containers.forEach(container => {
                    const items = container.querySelectorAll('.custom-img-item');
                    const maxVisibleImages = 3;

                    if (items.length > maxVisibleImages) {
                        for (let i = maxVisibleImages; i < items.length; i++) {
                            items[i].style.display = 'none';
                        }

                        const extraCount = items.length - maxVisibleImages;
                        const extraImagesDiv = document.createElement('div');
                        extraImagesDiv.className = 'extra-images';
                        extraImagesDiv.textContent = '+' + extraCount;

                        container.appendChild(extraImagesDiv);
                    }
                });
            });
        </script>
</body>

</html>
