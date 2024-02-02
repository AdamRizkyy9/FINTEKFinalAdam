    @extends('layouts.app')

<?php
$page = 'Home';
?>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2 class="font-weight-bold">Welcome to Your Dashboard</h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::user()->role_id === 3)
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="card bg-warning text-white text-center p-3">
                                        <h5 class="font-weight-bold">Top Up</h5>
                                        <p>Silahkan Top-Up dengan mengKlik button dibawah ini.</p>
                                        <a href="{{ route('topup') }}" class="btn btn-dark btn-sm">Top Up Now</a>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card bg-success text-white text-center p-3">
                                        <h5 class="font-weight-bold">Canteen 64</h5>
                                        <p>Bayar Jajan lewat online aja jadi gak ribet! tidak perlu pakai antri lagi buat
                                            bayar.</p>
                                        <a href="{{ route('transaksi') }}" class="btn btn-dark btn-sm">Explore</a>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card bg-info text-dark text-center p-3">
                                        <h5 class="font-weight-bold">Withdraw</h5>
                                        <p>Ambil uang anda disini. Tidak perlu ribet ke ATM !</p>
                                        <a href="{{ route('tariktunai') }}" class="btn btn-dark btn-sm">Withdraw Now</a>
                                    </div>
                        @endif

                        @if (Auth::user()->role_id === 1)
                    </div>
                    <div class="card col"
                        style="width: 100px; height: 100px; align-items:center; justify-content:center; margin:5px; background-color: #0e3991">
                        <a href="{{ route('transaksi_bank') }}"
                            style="color: white;text-decoration:none;font-size:18px">Transaction</a>
                    </div>
                    @endif
                    @if (Auth::user()->role_id === 3)
                    @endif
                    @if (Auth::user()->role_id === 1)
                        <table class="table table-bordered border-dark table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Nominal</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $key => $pengajuan)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $pengajuan->user->name }}</td>
                                        <td>{{ $pengajuan->jumlah }}</td>
                                        <td>
                                            <a href="{{ route('topup.setuju', ['transaksi_id' => $pengajuan->id]) }}"
                                                class="btn btn-primary">
                                                Accept
                                            </a>
                                            <a href="{{ route('topup.tolak', ['transaksi_id' => $pengajuan->id]) }}"
                                                class="btn btn-danger">
                                                Decline
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('tariktunai.setuju', ['transaksi_id' => $pengajuan->id]) }}"
                                                class="btn btn-primary">
                                                Accept
                                            </a>
                                            <a href="{{ route('tariktunai.tolak', ['transaksi_id' => $pengajuan->id]) }}"
                                                class="btn btn-danger">
                                                Decline
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                @endif
                @if (Auth::user()->role_id === 2)
                    <table class="table table-bordered border-dark table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                {{-- <th>Nominal</th> --}}
                                <th>Invoice ID</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jajan_by_invoices as $key => $jajan_by_invoice)
                                @if ($jajan_by_invoice->status == 2 || $jajan_by_invoice->status == 3)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $jajan_by_invoice->user->name }}</td>
                                        <td>{{ $jajan_by_invoice->invoice_id }}</td>
                                        {{-- <td>{{ $jajan_by_invoice->jumlah }}</td> --}}
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
                                                                                <td>{{ $pengajuan_jajan->barang->name }}
                                                                                </td>
                                                                                <td>{{ $pengajuan_jajan->jumlah }}
                                                                                </td>
                                                                                <td>{{ $pengajuan_jajan->barang->price }}
                                                                                </td>
                                                                                <td>{{ $pengajuan_jajan->jumlah * $pengajuan_jajan->barang->price }}
                                                                                </td>
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
                                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
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
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
