@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle d-flex align-items-center">
        <a href="{{ url('panel/closing/baa') }}" class="btn btn-danger me-2 btn-sm" style="background: #F43F5E;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 style="color: #F43F5E; font-weight: bold;">Tambah BAA</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah BAA Baru</h5>
                        <!-- General Form Elements -->
                        <form action="{{ route('baa.insert') }}" method="post" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Nama File</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" required name="nama_file"
                                        placeholder="Nama File">
                                    @error('nama_file')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="fileInput" class="file-label border-separate">
                                        <input type="file" id="fileInput" style="display: none; cursor: pointer;"
                                            name="dokumen">
                                        <span class="file-button">Pilih File</span>
                                        <span class="file-info" id="file-name">Tidak ada file yang dipilih</span>
                                    </label>
                                    @error('dokumen')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <p class="mt-3">Tipe file yang diterima:</p>
                                    <p>Dokumen PDF .pdf</p>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-sm-12" style="text-align: right;">
                                    <button type="submit" class="btn btn-tambah">Tambah BAA</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
