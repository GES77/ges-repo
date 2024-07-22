@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1 style="color: #F43F5E; font-weight: bold;">Tambah BASO</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah BASO Baru</h5>
                        <!-- General Form Elements -->
                        <form action="" method="post" novalidate>
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Nama File</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" required name="nama-file" placeholder="Nama File">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="fileInput" class="file-label border-separate">
                                        <input type="file" id="fileInput" style="display: none; cursor: pointer;">
                                        <span class="file-button">Pilih File</span>
                                        <span class="file-info">Tidak ada file yang dipilih</span>
                                    </label>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-sm-12" style="text-align: right;">
                                    <button type="submit" class="btn btn-tambah">Tambah BASO</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
