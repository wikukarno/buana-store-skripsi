@extends('layouts.member')
@section('title')
    Daftar Transaksi Saya
@endsection

@section('content')
<!-- Main content -->
    <section class="main-content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="mb-0 text-gray-800">Data Member Buana Store</h3>
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
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                    $no = 1;
                            @endphp
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td style="padding-left: 30px">{{ $no++ }}</td>
                                    <td style="padding-left: 25px">{{ $transaction->user->name }}</td>
                                    <td style="padding-left: 25px">{{ $transaction->code_product }}</td>
                                    <td style="padding-left: 25px">{{ $transaction->product->name_product }}</td>
                                    @if ($transaction->phone != null)
                                    <td style="padding-left: 18px">{{ $transaction->phone }}</td>
                                    @else
                                    <td class="text-center" style="padding-left: 18px"> - </td>
                                    @endif
                                    <td style="padding-left: 5px" class="text-center">{{ $transaction->quantity }}</td>
                                    @if ($transaction->payment_status == 'FAILED')
                                    <td style="padding-left: 18px"><strong class="text-white badge badge-danger">{{ $transaction->payment_status }}</strong></td>
                                    @elseif ($transaction->payment_status == 'PENDING')
                                    <td style="padding-left: 18px"><strong class="text-white badge badge-warning">{{ $transaction->payment_status }}</strong></td>
                                    @elseif ($transaction->payment_status == 'DIBAYAR')
                                    <td style="padding-left: 18px"><strong class="text-white badge badge-success">{{ $transaction->payment_status }}</strong></td>
                                    @else
                                    <td style="padding-left: 18px"><strong class="text-white badge badge-info">{{ $transaction->payment_status }}</strong></td>
                                    @endif
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
@endsection

@push('after-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.9/dist/sweetalert2.all.min.js"></script>
<script>
    var datatable =  $('#table').DataTable({
        processing: true,
        serverSide:true,
        ordering:true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns:[
            {data: 'id', name: 'id'},
            {data: 'user.name', name: 'user.name'},
            {data: 'code_product', name: 'code_product'},
            {data: 'product.name_product', name: 'product.name_product'},
            {data: 'payment_status', name: 'payment_status'},
            {data: 'quantity', name: 'quantity'},
            {data: 'total_price', name: 'total_price'},
            { 
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%' 
            },
        ]
    })
    
</script>
<script>
    $(document).on('click', '#hapus', function(){
    let url = $(this).data('url');
    let token = $(this).data('token')
    let id = $(this).data('id');
    let tr = this
    Swal.fire({ 
        title: 'Apakah anda yakin ?',
        text: "Data ini akan dihapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value)  {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        '_method': 'DELETE',
                        '_token': token,
                        'id': id
                    },
                    dataType: "JSON",
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            response.success,
                            'success'
                        )
                        $(tr).closest('tr').remove();
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swal.fire(
                    'Hapus data dibatalkan!',
                    'Data yang ingin anda hapus telah dibatalkan',
                    'error'
                )
            }
            
        });
    });
</script>
@endpush