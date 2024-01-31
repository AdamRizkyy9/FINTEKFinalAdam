@extends('layouts.app')

<?php
$page = 'Top Up';
?>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-radius: 20px">
                    <div class="card-header" style="background-color: #10d1f3; border-radius: 10px">Top Up</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h3>Saldo Anda: Rp {{ number_format($saldo->saldo, 0, ',', '.') }}</h3>

                        <div class="card border-0 shadow-lg p-4">
                            <form method="POST" action="{{ route('transaksi.create') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="jumlah">Masukkan Jumlah:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" name="jumlah" class="form-control" placeholder="Nominal" required>
                                    </div>
                                </div>

                                <input type="hidden" name="type" value="1">

                                <button class="btn btn-primary mt-3" type="submit">Top Up</button>
                            </form>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
