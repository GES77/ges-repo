{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGES</title> --}}
    <!-- {{-- icon --}} -->
    {{-- <link rel="icon" href="{{ url('') }}/assets/img/icon_telkom.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ url('') }}/assets/css/style_login.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">

</head> --}}

{{-- <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify OTP') }}</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div> @endif
                        <form method="POST"
        action="{{ route('otp.verify.post') }}">
    @csrf

    <div class="form-group row">
        <label for="otp" class="col-md-4 col-form-label text-md-right">{{ __('OTP') }}</label>

        <div class="col-md-6">
            <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp"
                required autofocus>

            @error('otp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Verify') }}
            </button>
        </div>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script src="{{ url('') }}/https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('') }}/https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/https://unpkg.com/bootstrap-show-password@1.3.0/dist/bootstrap-show-password.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    {{-- <script src="https://unpkg.com/bootstrap-show-password@1.3.0/dist/bootstrap-show-password.min.js"></script> --}}
    {{-- </body>

</html> --}}
