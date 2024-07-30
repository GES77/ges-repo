@extends('panel.layouts.app')

@section('content')
<div class="pagetitle d-flex align-items-center">
    <a href="{{ url('panel/user') }}" class="btn btn-danger me-2 btn-sm" style="background: #F43F5E;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h1 style="color: #F43F5E; font-weight: bold;">Tambah User</h1>
</div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah User Baru</h5>
                        <!-- General Form Elements -->
                        <form action="" method="post" novalidate>
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" required name="nama">
                                    @error('nama')
                                        <p style="color: #F43F5E; margin-top: 10px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Username</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" required name="username">
                                    @error('username')
                                        <p style="color: #F43F5E; margin-top: 10px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" required name="password">
                                    @error('password')
                                        <p style="color: #F43F5E; margin-top: 10px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Role</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="role_id" required id="">
                                        <option value="">Pilih Role</option>
                                        @foreach ($getRole as $value)
                                        <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <p style="color: #F43F5E; margin-top: 10px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12" style="text-align: right;">
                                    <button type="submit" class="btn btn-tambah">Tambah User</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
