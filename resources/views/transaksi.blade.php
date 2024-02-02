@extends('layouts.app')

<?php
$page = 'Jajan';
?>

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: #10d1f3">
                        <h5>SALDO: Rp {{ number_format($saldo->saldo, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header" style="background-color: #1e4ee0; font-weight: bold; color: white">Menu</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($barangs as $barang)
                                <div class="col col-md-3 mt-4" >
                                    <div class="card" style="border-color: black">
                                        <div class="card-body">
                                            <td>
                                                <img width="150" height="80" style="margin: 20px" src={{ asset('assets/images/' . $barang->image) }}
                                                    alt="not found" />
                                            </td>
                                            <div class="card-title">{{ $barang->name }}</div>
                                            <div>
                                                {{ $barang->desc }}
                                                <p>
                                                    Price: {{ $barang->price }}
                                                </p>
                                            </div>
                                        </div>
                                        <form class="m-2" method="POST"
                                            action="{{ route('addToCart', ['id' => $barang->id]) }}">
                                            @csrf
                                            <input type="number" name="jumlah" class="form-control" value="1">
                                            <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                                            <button class="btn btn-primary mt-2" type="submit">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
            <div class="card">
                <div class="card-header" style="background-color: #64B9F0; font-weight: bold; color: white">Chekcout {{ count($carts) > 0 ? '#' . $carts[0]->invoice_id : '' }}</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $key => $cart)
                                <tr >
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $cart->barang->name }}</td>
                                    <td>{{ $cart->barang->price }}</td>
                                    <td>{{ $cart->jumlah }}</td>
                                    <td>{{ $cart->barang->price * $cart->jumlah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">Total : {{ $total_cart }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
                </div>
            </div>
        </div>
        <br/>
            <div class="container">
                <div class="card">
                    <div class="card-header" style="background-color: #64B9F0; font-weight: bold; color: white">Buy {{ count($carts) > 0 ? '#' . $carts[0]->invoice_id : '' }}</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkouts as $key => $checkout)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $checkout->barang->name }}</td>
                                        <td>{{ $checkout->barang->price }}</td>
                                        <td>{{ $checkout->jumlah }}</td>
                                        <td>{{ $checkout->barang->price * $checkout->jumlah }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">Total : {{ $total_checkout }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('bayar') }}" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
