@extends('layouts.app', ['activePage' => 'bast', 'titlePage' => __('BAST')])
<!-- Navbar -->

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Users</h4>
                        <p class="card-category"> Here you can manage users</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ route('bast.create') }}" class="btn btn-sm btn-primary">Add user</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Nomor Surat
                                        </th>
                                        <th>
                                            Jumlah
                                        </th>
                                        <th>
                                            Creation date
                                        </th>
                                        <th class="text-right">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($basts as $bast)
                                    <tr>
                                        <td>
                                            {{ $bast->nomor }}
                                        </td>
                                        <td>
                                            {{ $bast->total }}
                                        </td>
                                        <td>
                                            2020-02-24
                                        </td>
                                        <td class="td-actions text-right">
                                            <a rel="tooltip" class="btn btn-info btn-link"
                                                href="{{ route('bast.destroy',$bast->nomor) }}" data-original-title="" title="">
                                                <i class="material-icons">edit</i>
                                                <!-- <div class="ripple-container"></div> -->
                                            </a>
                                            <a rel="tooltip" class="btn btn-info btn-link"
                                                href="{{ route('bast.print',$bast->nomor) }}" data-original-title="" title="">
                                                <i class="material-icons">print</i>
                                                <!-- <div class="ripple-container"></div> -->
                                            </a>
                                            <a href="{{ route('bast.destroy',$bast->nomor) }}" onclick="event.preventDefault();document.getElementById('delete-form').submit();" class="btn btn-danger btn-link">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <form id="delete-form" action="{{ route('bast.destroy',$bast->nomor) }}"
                                                method="post" style="display: none;">
                                                <input type="submit" value="Delete" />
                                                {!! method_field('delete') !!}
                                                {!! csrf_field() !!}
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>
                                            Tidak ada bast.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
