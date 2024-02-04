@extends('layouts.app')

<?php
$page = 'Home';
?>

<style>
    body{
    overflow: hidden;
    }
</style>

@section('content')
    <div class="container" style="margin-top: -50px; overflow: hidden;">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card border-6 shadow-lg">
                    <div class="card-header text-white text-center" style="background-color: #0C2D57">
                        <h2 class="font-weight-bold">Selamat Datang Di Dashboard</h2>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::user()->role_id === 3)
                            <div class="row justify-content-center mt-10">
                                <div class="col-md-4">
                                    <div class="card border-5 text-center p-3" style="background-color: #f9cb61;">
                                        <h5 class="font-weight-bold mb-4">Top Up</h5>
                                        <p class="mb-3">Silahkan Top-Up dengan mengKlik button di bawah ini.</p>
                                        <a href="{{ route('topup') }}" class="btn btn-dark btn-sm">Top Up</a>
                                    </div>
                                </p>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-5 text-center p-3" style="background-color: #80f0d8;">
                                        <h5 class="font-weight-bold mb-3">Kantin 64</h5>
                                        <p class="mb-3">Jajan lewat online aja jadi gak ribet! tidak perlu pakai sekarang!</p>
                                        <a href="{{ route('transaksi') }}" class="btn btn-dark btn-sm">Jajan</a>
                                    </div>
                                </div>
                                <p>
                                <div class="col-md-4">
                                    <div class="card border-5 text-center p-3" style="background-color: #69b7f6;">
                                        <h5 class="font-weight-bold mb-3">Tarik Tunai</h5>
                                        <p class="mb-3">Ambil uang anda disini. Tidak perlu ribet ke ATM</p>
                                        <a href="{{ route('tariktunai') }}" class="btn btn-dark btn-sm">Tarik</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (Auth::user()->role_id === 1)
                            <div class="card mt-2">
                                <div class="card-header bg-dark text-white">
                                    <h3 class="font-weight-bold">Bank Transaksi</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped mt-2">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Nominal</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengajuans as $key => $pengajuan)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $pengajuan->user->name }}</td>
                                                    <td>{{ $pengajuan->jumlah }}</td>
                                                    <td>
                                                        @if (Str::startsWith($pengajuan->invoice_id,  'SAL_'))
                                                            Topup
                                                        @elseif (Str::startsWith($pengajuan->invoice_id,  'TRK_'))
                                                            Tarik Tunai
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (Str::startsWith($pengajuan->invoice_id,  'SAL_'))
                                                            <a href="{{ route('topup.setuju', ['transaksi_id' => $pengajuan->id]) }}" class="btn btn-primary">
                                                                Setujui
                                                            </a>
                                                            <a href="{{ route('topup.tolak', ['transaksi_id' => $pengajuan->id]) }}" class="btn btn-danger">
                                                                Tolak
                                                            </a>
                                                        @elseif (Str::startsWith($pengajuan->invoice_id, 'TRK_'))
                                                            <a href="{{ route('tariktunai.setuju', ['transaksi_id' => $pengajuan->id]) }}" class="btn btn-primary">
                                                                Setujui
                                                            </a>
                                                            <a href="{{ route('tariktunai.tolak', ['transaksi_id' => $pengajuan->id]) }}" class="btn btn-danger">
                                                                Tolak
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        @if (Auth::user()->role_id === 2)
                            <div class="card mt-2">
                                <div class="card-header bg-dark text-white">
                                    <h3 class="font-weight-bold">Transaksi Kantin</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped mt-3">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Nominal</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jajan_by_invoices as $key => $jajan_by_invoice)
                                                @if ($jajan_by_invoice->status == 2 || $jajan_by_invoice->status == 3)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $jajan_by_invoice->user->name }}</td>
                                                        <td>{{ $jajan_by_invoice->invoice_id }}</td>
                                                        <td>{{ $jajan_by_invoice->status == 2 ? 'Pending' : 'Menunggu Confirm Kantin' }}</td>
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#detail-{{ $jajan_by_invoice->invoice_id }}">
                                                                Detail
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="detail-{{ $jajan_by_invoice->invoice_id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                                Order #{{ $jajan_by_invoice->invoice_id }}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <table class="table table-bordered border-dark table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No.</th>
                                                                                        <th>Menu</th>
                                                                                        <th>Qty</th>
                                                                                        <th>Price</th>
                                                                                        <th>Total</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $counter = 1;
                                                                                    $total_harga = 0;
                                                                                    ?>
                                                                                    @foreach ($pengajuan_jajans as $pengajuan_jajan)
                                                                                        @if ($pengajuan_jajan->invoice_id == $jajan_by_invoice->invoice_id)
                                                                                            <?php $total_harga += $pengajuan_jajan->jumlah * $pengajuan_jajan->barang->price; ?>
                                                                                            <tr>
                                                                                                <td>{{ $counter++ }}</td>
                                                                                                <td>{{ $pengajuan_jajan->barang->name }}</td>
                                                                                                <td>{{ $pengajuan_jajan->jumlah }}</td>
                                                                                                <td>{{ $pengajuan_jajan->barang->price }}</td>
                                                                                                <td>{{ $pengajuan_jajan->jumlah * $pengajuan_jajan->barang->price }}</td>
                                                                                            </tr>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                            Total = {{ $total_harga }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @if ($jajan_by_invoice->status == 3)
                                                                <a href="{{ route('jajan.setuju', ['invoice_id' => $jajan_by_invoice->invoice_id]) }}"
                                                                    class="btn btn-primary">
                                                                    Accept
                                                                </a>
                                                                <a href="{{ route('jajan.tolak', ['invoice_id' => $jajan_by_invoice->invoice_id]) }}"
                                                                    class="btn btn-danger">
                                                                    Decline
                                                                </a>
                                                            @else
                                                                Menunggu Pembayaran
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
