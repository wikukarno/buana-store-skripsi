@extends('layouts.member')
@section('title')
    Daftar Transaksi Penjualan
@endsection

@section('content')
<!-- Main content -->
    <section class="main-content">
        @if (count($transaction))
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="mb-0 text-gray-800">Data Transaksi Penjualan</h3>
                        <a href="{{ route('pdf-transaction-seller')}}" class="btn btn-success shadow-sm">
                            <i class="fas fa-print fa-sm text-white-50"></i>
                            Cetak Transaksi
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>No. Hp</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- @php
                                            $no = 1;
                                    @endphp --}}
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td style="padding-left: 30px">{{ $loop->iteration }}</td>
                                            <td style="padding-left: 25px">{{ $transaction->name }}</td>
                                            <td style="padding-left: 25px">{{ $transaction->code_product }}</td>
                                            <td style="padding-left: 25px">{{ $transaction->product->name_product }}</td>
                                            @if ($transaction->phone != null)
                                            <td style="padding-left: 18px">{{ $transaction->phone }}</td>
                                            @else
                                            <td class="text-center" style="padding-left: 18px"> - </td>
                                            @endif
                                            <td style="padding-left: 5px" class="text-center">{{ $transaction->quantity }}</td>
                                            <td style="padding-left: 18px">{{ $transaction->created_at->isoFormat('D MMMM Y') }}</td>
                                            @if ($transaction->transaction->payment_status == 'FAILED')
                                            <td style="padding-left: 18px"><strong class="text-white badge badge-danger">{{ $transaction->transaction->payment_status }}</strong></td>
                                            @elseif ($transaction->transaction->payment_status == 'PENDING')
                                            <td style="padding-left: 18px"><strong class="text-white badge badge-warning">{{ $transaction->transaction->payment_status }}</strong></td>
                                            @elseif ($transaction->transaction->payment_status == 'DIBAYAR')
                                            <td style="padding-left: 18px"><strong class="text-white badge badge-success">{{ $transaction->transaction->payment_status }}</strong></td>
                                            @else
                                            <td style="padding-left: 18px"><strong class="text-white badge badge-info">{{ $transaction->transaction->payment_status }}</strong></td>
                                            @endif
                                            <td style="padding-left: 25px">Rp.{{ $transaction->transaction->total_price }}</td>
                                            <td style="padding-left: 25px">
                                                <a href="{{ route('transaction-seller.edit', $transaction->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                            </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        @else

        <div class="row">
            <div class="col-md-12 text-center">
                <div class="card">
                    <div class="card-body">
                        <figure class="figure">
                            <img src="{{ url('/images/ic_empty_cart.svg') }}" class="img-fluid figure-img h-75 w-75" alt="">
                        </figure>
                        <div class="description mt-3">
                            <h3>Belum ada Transaksi!</h3>
                            Silahkan belanja terlebih dahulu.
                        </div>
                        <div class="add-slider mt-4">
                            <a href="{{ route('home')}}" class="btn btn-success btn-lg shadow-sm">
                                <i class="fas fa-plus fa-sm text-white-50"></i>
                                Belanja Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
@endsection