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
                    <h3 class="card-title">Lihat list data Penjualan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="/penjualan/create" class="btn btn-warning">Tambah penjualan</a>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nomor Struk</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Pelanggan</th>
                                <th>Total Transaksi</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penjualan as $row)
                            <tr>
                                <td>{{$row->nomor_struk}}</td>
                                <td>{{$row->tanggal}}</td>
                                <td>{{$row->nama}}</td>
                                <td>{{$row->total}}</td>
                                <td>
                                    <a href="#">View</a>
                                    <a href="/penjualan/{{$row->nomor_struk}}/edit">Edit</a>
                                    <a href="/penjualan/{{$row->nomor_struk}}" onclick="event.preventDefault();document.getElementById('delete-form').submit();">Delete</a>
                                    <form id="delete-form" action="/penjualan/{{$row->nomor_struk}}" method="post" style="display: none;">
                                        <input type="submit" value="Delete" />
                                        {!! method_field('delete') !!}
                                        {!! csrf_field() !!}
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>No Records Found</tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $("#example1").DataTable();
    });
</script>
@endpush