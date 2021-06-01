@extends('layouts.app', ['activePage' => 'bast', 'titlePage' => __('BAST')])

@section('css')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@stop

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="form-group">
            <div class="col-md-12">

                <form method="post" action="{{ route('bast.store') }}" autocomplete="off" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Edit Profile</h4>
                            <p class="card-category">User information</p>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nomor</label>
                                <input class="form-control{{ $errors->has('nomor') ? ' is-invalid' : '' }}" name="nomor"
                                    type="text" placeholder="{{ __('Nomor') }}" required />
                            </div>

                            <div class="form-group">
                                <label>Hari</label>
                                <select class="form-control selectpicker" data-style="btn btn-link" name="hari"
                                    data-live-search="true">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal</label>
                                <input class="form-control{{ $errors->has('tanggal') ? ' is-invalid' : '' }}"
                                    name="tanggal" type="text" placeholder="{{ __('Tanggal') }}" required />
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">Edit Profile</h4>
                                    <p class="card-category">User information</p>
                                </div>
                                <div class="card-body">

                                    <!-- pihak pertama -->
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control{{ $errors->has('nama_psatu') ? ' is-invalid' : '' }}"
                                            name="nama_psatu" type="text" placeholder="{{ __('Tanggal') }}" required />
                                    </div>

                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input
                                            class="form-control{{ $errors->has('jabatan_psatu') ? ' is-invalid' : '' }}"
                                            name="jabatan_psatu" type="text" placeholder="{{ __('Jabatan') }}"
                                            required />
                                    </div>

                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input class="form-control{{ $errors->has('nip_psatu') ? ' is-invalid' : '' }}"
                                            name="nip_psatu" type="text" placeholder="{{ __('NIP') }}" required />
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">Edit Profile</h4>
                                    <p class="card-category">User information</p>
                                </div>
                                <div class="card-body">

                                    <!-- pihak kedua -->
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control{{ $errors->has('nama_pdua') ? ' is-invalid' : '' }}"
                                            name="nama_pdua" type="text" placeholder="{{ __('Tanggal') }}" required />
                                    </div>

                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input
                                            class="form-control{{ $errors->has('jabatan_pdua') ? ' is-invalid' : '' }}"
                                            name="jabatan_pdua" type="text" placeholder="{{ __('Jabatan') }}"
                                            required />
                                    </div>

                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input class="form-control{{ $errors->has('nip_pdua') ? ' is-invalid' : '' }}"
                                            name="nip_pdua" type="text" placeholder="{{ __('NIP') }}" required />
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Edit Profile</h4>
                            <p class="card-category">User information</p>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table class="table table-shopping" id="products_table">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th class="text-center">Banyak</th>
                                            <th class="text-right">Harga Satuan (Rp)</th>
                                            <th class="text-right">Jumlah (Rp)</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="product0">
                                            <td>
                                                <input type="text" name="nama_barang[]" class="form-control" />
                                            </td>

                                            <td>
                                                <input type="number" name="banyak[]" class="form-control text-center"
                                                    min="0" onchange="jumlah(this)"/>
                                            </td>

                                            <td>
                                                <input type="number" name="harga_satuan[]"
                                                    class="form-control text-right" min="0" onchange="jumlah(this)"/>
                                            </td>

                                            <td>
                                                <input type="number" name="jumlah[]" class="form-control text-right jumlah"
                                                    min="0" />
                                            </td>

                                            <td>
                                                <input type="text" name="keterangan[]" class="form-control" />
                                            </td>
                                        </tr>
                                        <tr id="product1"></tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <label>Total</label>
                                <input class="form-control" id="hasil" name="total"
                                    type="text" value="0"/>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                    <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                                </div>
                            </div>



                        </div>

                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<!--Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>

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

    // hitung total
    var ttl = document.getElementsByClassName("jumlah");
    var hasil = document.getElementsByClassName("hasil");
    var hasil2 = 0;

    function jumlah(e) {
        var parent = $(e).closest('tr').attr('id');
        console.log(ttl);
        
        var banyak = $("#" + parent).find('input[name^="banyak"]').val();
        var harga_satuan = $("#" + parent).find('input[name^="harga_satuan"]').val();
        var sum = banyak * harga_satuan;
        $("#" + parent).find('input[name^="jumlah"]').val(sum);

        hasil2 = 0;
        for (var i = 0; i < ttl.length; i++) {
            hasil2 += Number(ttl[i].value);
        }
        console.log(hasil2);
        document.getElementById("hasil").value = hasil2;
    };

</script>
@endpush
