@extends('layouts.home')

@section('title')
    Transaksi - {{ Auth::user()->name }}
@endsection

@section('content')

<section class="section-transaction">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-12 col-md-8">
				@if ($transactions->transaction->payment_status == 'MENUNGGU')
					<div class="card">
						<div class="card-header text-center">
							<h3 class="card-title">Detail Transaksi Pembelian</h3>
							<span>An. {{ Auth::user()->name }}</span>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								@php
									$totalPrice = 0;
								@endphp
								<table class="scroll-horizontal-vertical w-100">
									<tr>
										<div class="form-group">
											<th>ID Pesanan</th>
											<td class="text-end">{{ $transactions->transaction->order_id }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Kode Produk</th>
											<td class="text-end">{{ $transactions->product->code }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Nama Barang</th>
											<td class="text-end">{{ $transactions->product->name_product }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>No Hp</th>
											<td class="text-end">{{ $transactions->phone }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Nama Penerima</th>
											<td class="text-end">{{ $transactions->name }}</td>
										</div>
									</tr>
								</table>
							</div>
							<hr />
							<div class="code-bstore table-responsive">
								<table class="scroll-horizontal-vertical w-100">
									<tr>
										<div class="form-group">
											<th>Harga</th>
											<td class="text-end">Rp.{{ number_format($transactions->product->price) }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Jumlah Pesanan</th>
											<td class="text-end">{{ $transactions->quantity }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Ongkir</th>
											<td class="text-end">Rp.{{ number_format($transactions->product->ongkir_amount) }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Biaya Admin</th>
											<td class="text-end">Rp.{{ number_format($transactions->transaction->admin_fee) }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Diskon</th>
											@if ($transactions->transaction->discount == true)
												<td class="text-end">{{ $transaction->product->discount_amount }}</td>
											@else
												<td class="text-end"> - </td>
											@endif
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Kode Unik</th>
											<td class="text-end">{{ $transactions->transaction->code_unique }}</td>
										</div>
									</tr>
								</table>
							</div>
							<hr />
							@php
									$admin_fee = 5000;
									$total = $transactions->product->price * $transactions->quantity;
									$totalPrice += $total + $transactions->product->ongkir_amount + $admin_fee;
								@endphp
							<div class="subtotal table-responsive">
								<table class="scroll-horizontal-vertical w-100">
									<tr>
										<div class="form-group">
											<th><b>Total Pembayaran</b></th>
											<td class="text-end"><strong class="text-success">Rp.{{ number_format($totalPrice + $transactions->transaction->code_unique) ?? 0 }}</strong></td>
										</div>
									</tr>
								</table>
							</div>
							<div class="d-grid gap-1 mt-3">
								<a href="" class="btn btn-payment" type="button">Bayar Sekarang</a>
							</div>
						</div>
					</div>
				@else
					<section class="section-empty-cart">
						<div class="container">
							<div class="row">
								<div class="col-12 col-md-12 text-center">
								<div class="empty-cart text-center">
									<figure class="figure">
										<img src="{{ url('/images/ic_empty_cart.svg') }}" class="img-fluid figure-img h-50 w-50" alt="">
									</figure>
									<div class="description mt-3">
										<h1>Belum ada Transaksi!</h1>
										Silahkan belanja terlebih dahulu.
									</div>
									<div class="add-slider mt-4">
										<a href="{{ route('home')}}" class="btn btn-get-product btn-lg shadow-sm">
											<i class="fas fa-plus fa-sm text-white-50"></i>
											Belanja Sekarang
										</a>
									</div>
								</div>
								</div>
							</div>
						</div>
					</section>
				@endif
			</div>
		</div>
	</div>
</section>
@endsection

@push('after-style')
    <style>
      .section-empty-cart{
        margin-top: 60px;
      }

	.badge{
		  font-size: 16px;
		  font-weight: 400;
	  }

      h1{
          font-size: 32px;
          font-family: "Merriweather";
          font-weight: 600;
          color: #1e124c;
      }
      .description{
        color: #525252;
        font-size: 16px;
        font-weight: 400;
      }
      .btn-get-product{
        background: #a43ce3;
        border-radius: 25px;
        color: #fff;
        font-size: 16px;
      }
      .btn-get-product:hover{
        background: #882ec0;
        color: #fff;
      }

      .btn-payout{
        background: #a43ce3;
        border-radius: 25px;
        color: #fff;
        font-size: 16px;
      }
      .btn-payout:hover{
        background: #882ec0;
        color: #fff;
      }
    </style>
@endpush

@push('after-script')
<script>
	$(document).on('click', '.changeQuantity', function(){
		if($(this).hasClass('qtyMinus')){
			const quantity = $(this).next().val();
			if (quantity <= 1) {
				alert("Quantity must be 1 or greater!");
				return false;
			}else{
				new_qty = parseInt(quantity)-1;
			}
		}
		if($(this).hasClass('qtyPlus')){
			const quantity = $(this).prev().val();
			new_qty = parseInt(quantity)+1;
		}
		const cartid = $(this).data('cartid');
		$.ajax({
			
			type: "post",
			url: "/keranjang",
			data: {
				"_token": "{{ csrf_token() }}",
				"cartid":cartid,
				"qty":new_qty
			},
			dataType: "json",
			success: function (response) {
				window.location.reload();
				$("#AppendCartItems");
			},error:function(){
				alert("error");
			}
		});
	});
</script>
@endpush