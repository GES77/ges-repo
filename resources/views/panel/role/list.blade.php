@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1 class="" style="color: #F43F5E; font-weight: bold;">Role</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('auth._message')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title" >List Role</h5>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                @if (!empty($PermissionAdd))
                                <a href="{{ url('panel/role/add') }}" class="btn btn-tambah" style="margin-top: 10px;">
                                    <i class="bi bi-plus-square-fill"></i>
                                    <span>Tambah Role</span>
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable border">
                            <thead>
                                <tr>
                                    <th>Nama Role</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($getRecord as $value)
                                <tr>
                                    <td>{{ $value->nama }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        @if (!empty($PermissionEdit))
                                        <a href="{{ url('panel/role/edit/'.$value->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                        @endif

                                        @if (!empty($PermissionDelete))
                                        <a href="{{ url('panel/role/delete/'.$value->id) }}" class="btn btn-hapus btn-sm">Hapus</a>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
