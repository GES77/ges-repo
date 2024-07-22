@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>OBL > P8</h3>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('auth._message')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">List P8</h5>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                @if (!empty($PermissionAdd))
                                <a href="{{ url('panel/obl/p8/add') }}" class="btn btn-tambah" style="margin-top: 10px;">
                                    <i class="bi bi-plus-square-fill"></i>
                                    <span>Tambah P8</span>
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable border">
                            <thead>
                                <tr>
                                    <th>Tanggal Dibuat</th>
                                    <th>Nama Uploader</th>
                                    <th>Judul Dokumen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>nama</td>
                                    <td>nama</td>
                                    <td>nama</td>
                                    <td>
                                        @if (!empty($PermissionEdit))
                                        <a href="{{ url('') }}"
                                            class="btn btn-edit btn-sm">Edit</a>
                                        @endif

                                        @if (!empty($PermissionPreview))
                                        <a href="{{ url('') }}"
                                            class="btn btn-preview btn-sm">Preview</a>
                                        @endif

                                        @if (!empty($PermissionDownload))
                                        <a href="{{ url('') }}"
                                            class="btn btn-download btn-sm">Download</a>
                                        @endif

                                        @if (!empty($PermissionDelete))
                                        <a href="{{ url('') }}"
                                            class="btn btn-hapus btn-sm">Hapus</a>
                                        @endif

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
