@extends('layouts.menu')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Penjualan</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah data Penjualan</h3>
                </div>
                <form action="/penjualan" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nomor Struk</label>
                        <input type="text" class="form-control" name="nomor_struk" value="{{$id}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="date" class="form-control" name="tanggal" value="">
                    </div>
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select name="id_pelanggan" class="form-control">
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggan as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input type="text" class="form-control" id="hasil" name="hasil" readonly value="0">
                    </div>

                        {!! csrf_field() !!}
                        <div class="card">
                            <div class="card-header">
                                Products
                            </div>

                            <div class="card-body">
                                <table class="table" id="products_table">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga per Unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <tr id="product0">
                                            <td>
                                                <select name="id_barang[]" class="form-control select"
                                                    onchange="calculate(this)">
                                                    <option value="">-- choose product --</option>
                                                    @foreach ($barang as $product)
                                                    <option value="{{ $product->id }}"
                                                        data-price="{{ $product->harga }}">
                                                        {{ $product->nama_barang }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah[]" class="form-control" value="0" min="0"
                                                    onchange="total(this)" />
                                            </td>
                                            <td>
                                                <input type="number" name="harga[]" class="form-control" value="0"
                                                    onchange="total(this)" readonly />
                                            </td>
                                            <td>
                                                <input type="number" name="total[]" class="form-control total" value="0"
                                                    readonly />
                                            </td>
                                        </tr>
                                        <tr id="product1"></tr>
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                        <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        let row_number = 1;
        $("#add_row").click(function (e) {
            e.preventDefault();
            $("<tr id='product" + (row_number + 1) + "'></tr>").appendTo('#products_table');
            $('#product' + row_number).html($('#product' + (row_number - 1)).html()).find(
                'td:last-child');
            row_number++;
        });

        $("#delete_row").click(function (e) {
            e.preventDefault();
            if (row_number > 1) {
                $("#product" + (row_number - 1)).html('');
                row_number--;
                console.log(row_number);
            }
        });
    });

    function calculate(e) {
        newPrice = $(e).children(':selected').data('price');

        var parent = $(e).closest('tr').attr('id');
        $("#" + parent).find('input[name^="harga"]').val(newPrice);

    };

    var ttl = document.getElementsByClassName("total");
    var hasil = document.getElementsByClassName("hasil");
    var hasil2 = 0;

    function total(e) {
        var parent = $(e).closest('tr').attr('id');
        console.log(ttl);
        
        var harga = $("#" + parent).find('input[name^="harga"]').val();
        var jumlah = $("#" + parent).find('input[name^="jumlah"]').val();
        var sum = harga * jumlah;
        $("#" + parent).find('input[name^="total"]').val(sum);


        for (var i = 0; i < ttl.length; i++) {
            hasil2 += Number(ttl[i].value);
        }
        console.log(hasil2);
        document.getElementById("hasil").value = hasil2;
    };


</script>
@endpush