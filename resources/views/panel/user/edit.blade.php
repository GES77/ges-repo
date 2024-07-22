@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1 style="color: #F43F5E; font-weight: bold;">Edit User</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit User</h5>
                        <!-- General Form Elements -->
                        <form action="" method="post" novalidate>
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" value="{{ $getRecord->nama }}" required name="nama">
                                    @error('nama')
                                        <p style="color: #F43F5E; margin-top: 10px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Username</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" value="{{ $getRecord->username }}" readonly name="username">
                                    @error('username')
                                        <p style="color: #F43F5E; margin-top: 10px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" name="password">
                                    <p style="color: #F43F5E; margin-top: 10px;">
                                        (Kosongkan jika anda tidak ingin mengganti password,tetapi jika ingin mengganti password isi minimal 8 karakter)
                                    </p>
                                    @error('password')
                                        <p style="color: #F43F5E; margin-top: 10px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Role</label>
                                <div class="col-sm-12">
                                    <select class="form-control cursor-pointer" name="role_id" required id="">
                                        <option value="">Pilih Role</option>
                                        @foreach ($getRole as $value)
                                        <option {{  ($getRecord->role_id == $value->id) ? 'selected' : ''  }} value="{{ $value->id }}">{{ $value->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <p style="color: #F43F5E; margin-top: 10px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12" style="text-align: right;">
                                    <button type="submit" class="btn btn-tambah">Edit User</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
