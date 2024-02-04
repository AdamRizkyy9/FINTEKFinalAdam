@extends('layouts.app')

<?php
$page = ' Data Transaksi';
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
                <h2 class="text-center mb-4">Riwayat Transaksi</h2>
            </div>
        </div>

        @forelse ($transaksis as $key => $transaksi)
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card shadow-lg border-primary mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $transaksi->user->name }}</h5>
                            <p class="card-text">
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
                                        <span class="badge bg-secondary">FINISHED</span>
                                        @break
                                    @default
                                @endswitch
                            </p>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#detail-{{ $transaksi->invoice_id }}">View Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="detail-{{ $transaksi->invoice_id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Details for Invoice #{{ $transaksi->invoice_id }}</h5>
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
                            </p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
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
                            <p><strong>Total:</strong> {{ $total_harga }}</p>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-primary print-button" onclick="window.print()">
                                    PRINT
                                </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <p class="text-center">Tidak ada transaksi</p>
                </div>
            </div>
        @endforelse
    </div>
@endsection

<style>
    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.3rem 0.6rem;
        border-radius: 0.25rem;
    }

    .badge.bg-warning {
        background-color: #ffc107;
    }

    .badge.bg-info {
        background-color: #17a2b8;
    }

    .badge.bg-success {
        background-color: #28a745;
    }

    .badge.bg-secondary {
        background-color: #6c757d;
    }
</style>
    