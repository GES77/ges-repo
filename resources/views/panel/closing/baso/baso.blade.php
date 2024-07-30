@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Closing > BASO</h3>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('auth._message')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">List BASO</h5>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                @if (!empty($PermissionAdd))
                                <a href="{{ url('panel/closing/baso/add') }}" class="btn btn-tambah" style="margin-top: 10px;">
                                    <i class="bi bi-plus-square-fill"></i>
                                    <span>Tambah BASO</span>
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
                                @forelse ($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->created_at->format('d M Y') }}</td>
                                        <td>{{ $value->uploader }}</td>
                                        <td>{{ $value->nama_file }}</td>
                                        <td>
                                            @if (!empty($PermissionEdit))
                                                <a href="{{ route('baso.edit', $value->id) }}"
                                                    class="btn btn-edit btn-sm mt-1">Edit</a>
                                            @endif

                                            @if (!empty($PermissionPreview))
                                                <a href="{{ route('baso.preview', $value->id) }}"
                                                    class="btn btn-preview btn-sm mt-1">Preview</a>
                                            @endif

                                            @if (!empty($PermissionDownload))
                                                <a href="{{ route('baso.download', $value) }}"
                                                    class="btn btn-download btn-sm mt-1">Download</a>
                                            @endif

                                            @if (!empty($PermissionDelete))
                                                <a href="{{ route('baso.delete', $value->id) }}"
                                                    class="btn btn-hapus btn-sm mt-1">Hapus</a>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data masih kosong</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
