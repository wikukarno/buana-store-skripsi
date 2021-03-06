@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Page Heading -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('products-admin.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf                  
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}"/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo" class="form-control-label">Foto</label>
                                    <input  type="file"
                                            name="photo[]" 
                                            value="{{ old('photo') }}" 
                                            multiple
                                            class="form-control @error('photo') is-invalid @enderror"/>
                                    @error('photo') <div class="text-muted">{{ $message }}</div> @enderror
                                    <span>* Kamu dapat upload lebih dari 1 foto</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_product" class="form-control-label">Nama Produk</label>
                                    <input type="text" name="name_product" value="{{ old('name_product') }}" class="form-control @error('name_product') is-invalid @enderror"/>
                                    @error('name_product') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categories_id" class="form-control-label">Kategori Produk</label>
                                    <select name="categories_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Harga Produk</label>
                                    <input type="number" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror"/>
                                    @error('price') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row" id="discount">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Kasih Diskon  / Tidak</label>
                                        <div class="form-group form-check py-2" id="checkbox">
                                            <input type="checkbox" class="form-check-input" name="discount" value="1">
                                            <label class="form-check-label" for="exampleCheck1">Kasih Diskon</label>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_amount" class="form-control-label">Jumlah Discount</label>
                                    <input disabled type="number" name="discount_amount" value="{{ old('discount_amount') }}" class="form-control inputDisabled @error('discount_amount') is-invalid @enderror"/>
                                    @error('discount_amount') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Isi Deskripsi Produk</label>
                                    <textarea name="description"
                                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description') <div class="text-muted">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <a href="{{ route('products-admin.index') }}" class="btn btn-danger btn-block">
                                    Batal
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-success btn-block">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script>
    function thisFileUpload(){
        document.getElementById('file').click();
    }
</script>

<script>
    $(".form-check-input").click(function(){
        if ($(this).prop('checked')) {
            $('.inputDisabled').prop("disabled", false);
        } else {
            $('.inputDisabled').prop("disabled", true);
        }
    });
</script>
@endpush