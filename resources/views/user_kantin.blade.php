@extends('layouts.app')

<?php
$page = 'Transaksi Kantin';
?>

@section('content')
    <div class="container mt-4">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Transaksi</h2>
            </div>
        </div>

        <div class="row">
            @foreach ($transaksis as $key => $transaksi)
            <div class="col-md-3 mb-4">
                <div class="card" style="border: none; box-shadow: 5px 3px 10px 10px rgba(0, 0, 255, 0.1);">
                    <div class="card-body">
                            <h5 class="card-title text-center">{{ $transaksi->user->name }}</h5>
                            <p class="card-text text-center">
                                <strong>Invoice ID:</strong> {{ $transaksi->invoice_id }}<br>
                                <strong>Status:</strong>
                                @switch($transaksi->status)
                                    @case(1)
                                        <span class="badge bg-warning text-dark">ON CART</span>
                                        @break
                                    @case(2)
                                        <span class="badge bg-info text-dark">PENDING</span>
                                        @break
                                    @case(3)
                                        <span class="badge bg-success">COMPLETED</span>
                                        @break
                                    @case(4)
                                        <span class="badge bg-success">FINISHED</span>
                                        @break
                                    @case(5)
                                        <span class="badge bg-secondary">FAILED</span>
                                        @break
                                    @default
                                @endswitch
                            </p>
                            <div class="text-center mt-4">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detail-{{ $transaksi->invoice_id }}">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="detail-{{ $transaksi->invoice_id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi #{{ $transaksi->invoice_id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>User:</strong> {{ $transaksi->user->name }}</p>
                                <p><strong>Status:</strong>
                                    @switch($transaksi->status)
                                        @case(1)
                                            ON CART
                                            @break
                                        @case(2)
                                            PENDING
                                            @break
                                        @case(3)
                                            COMPLETED
                                            @break
                                        @case(4)
                                            FINISHED
                                            @break
                                        @default
                                    @endswitch
                                    <p><strong>Date:</strong> {{ $transaksi->created_at->format('d/m/Y H:i:s') }}</p>
                                </span>
                            </p>
                                </p>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total_harga = 0; ?>
                                    @foreach ($details as $detail)
                                        @if ($detail->invoice_id == $transaksi->invoice_id)
                                            <?php $total_harga += $detail->jumlah * $detail->barang->price; ?>
                                            <tr>
                                                <td>{{ $detail->barang->name }}</td>
                                                <td>{{ $detail->jumlah }}</td>
                                                <td>{{ $detail->barang->price }}</td>
                                                <td>{{ $detail->jumlah * $detail->barang->price }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
