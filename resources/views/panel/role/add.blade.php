@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle d-flex align-items-center">
        <a href="{{ url('panel/role') }}" class="btn btn-danger me-2 btn-sm" style="background: #F43F5E;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 style="color: #F43F5E; font-weight: bold;">Role</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Role Baru</h5>

                        <!-- General Form Elements -->
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Nama Role</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" required name="nama">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label style="display: block; margin-bottom:20px;" for="inputText"
                                    class="col-sm-12 col-form-label"><b>Permission</b></label>
                                @foreach ($getPermission as $value)
                                    <div class="row" style="margin-bottom: 20px;">
                                        <div class="col-md-3">
                                            {{ $value['nama'] }}
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                @foreach ($value['group'] as $group)
                                                <div class="col-md-4 mt-2">
                                                    <label><input type="checkbox" value="{{ $group['id'] }}" name="permission_id[]" style="margin-right: 10px;">{{ $group['nama'] }}</label>
                                                </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-12" style="text-align: right;">
                                    <button type="submit" class="btn btn-tambah">Tambah Role</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
