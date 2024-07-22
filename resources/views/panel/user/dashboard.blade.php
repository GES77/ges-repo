@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Hallo {{ Auth::user()->nama }}!</h3>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('auth._message')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">List User</h5>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                @if (!empty($PermissionAdd))
                                    <a href="{{ url('panel/user/add') }}" class="btn btn-tambah" style="margin-top: 10px;">
                                        <i class="bi bi-plus-square-fill"></i>
                                        <span>Tambah User</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable border">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role ID</th>
                                    <th>Tanggal Dibuat</th>
                                    @if (!empty($PermissionEdit) || !empty($PermissionDelete))
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->nama }}</td>
                                        <td>{{ $value->username }}</td>
                                        <td>{{ $value->role_name }}</td>
                                        <td>{{ $value->created_at }}</td>
                                        @if (!empty($PermissionEdit) || !empty($PermissionDelete))
                                            <td>
                                                @if (!empty($PermissionEdit))
                                                    <a href="{{ url('panel/user/edit/' . $value->id) }}"
                                                        class="btn btn-edit btn-sm">Edit</a>
                                                @endif
                                                @if (!empty($PermissionDelete))
                                                    <a href="{{ url('panel/user/delete/' . $value->id) }}"
                                                        class="btn btn-hapus btn-sm">Hapus</a>
                                                @endif
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
                {{-- <div class="footer mt-auto mb-1">
                    <div class="role">
                        <div class="column text-c">
                            <div class="d-flex align-items-center justify-content-center mt-1">
                                <p class="mb-1"><b>{{ Auth::user()->nama }}</b> </p>
                            </div>
                            <div class="d-flex align-items-center justify-content-center   ">
                                @foreach ($getRecord as $value)
                                <p>{{ $value->role_name }}</p>
                                @endforeach
                                <p>{{ $roleName }}</p>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </section>
@endsection
