<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyGES</title>
    <!-- {{-- icon --}} -->
    <link rel="icon" href="{{ url('') }}/assets/img/icon_telkom.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ url('') }}/assets/css/style_login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 half-screen colored-half d-flex align-items-center justify-content-center">
                <div class="content">
                    <h1 class="text-white ">Selamat Datang</h1>
                    <p class="text-white ">Selamat Pagi! Pagi! Pagi! Pagi!</p>
                    <img src="{{ url('') }}/assets/img/illus_login.png" class="img_login "
                        alt="Colored half illustration">
                </div>
                <svg class="top-left-curve " viewBox="0 0 400 400" preserveAspectRatio="none">
                    <path d="M0,100 Q90,50 100,0" stroke="white" stroke-opacity="0.5" stroke-width="4" fill="none" />
                </svg>
                <svg class="bottom-right-curve " viewBox="0 -10 50 100" preserveAspectRatio="none">
                    <path d="M20,120 Q30,30 100,100" stroke="white" stroke-width="1" fill="none" />
                </svg>
            </div>
            <div class="col-md-6 half-screen white-half d-flex align-items-center justify-content-center">
                <div class="login-form">
                    <h2 class="">OTP</h2>
                    <p class="">Silahkan lihat kode OTP yang telah dikirimkan melalui Telegram</p>

                    @include('auth._message')

                    <form action="{{ route('otp.verify.post') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group mt-4 ">
                            <label for="otp">OTP<span style="color: red">*</span></label>
                            <input id="otp" type="text" maxlength="6"
                                class="form-control @error('otp') is-invalid @enderror" name="otp" required
                                autofocus placeholder="Input kode OTP anda">
                            @error('otp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="btn btn-login text-white mt-2 " type="submit">
                            {{-- <a href="admin" class="text-white text-decoration-none"> --}}
                            Verifikasi
                            {{-- </a> --}}
                        </button>
                    </form>
                    <form action="{{ route('otp.resend') }}" method="post" style="margin-top: 10px;">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary " id="resend-otp-btn">Resend OTP</button>
                    </form>
                    {{-- <div id="timer" class="mt-3"></div> --}}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('') }}/assets/js/timer.js"></script>
    <script src="{{ url('') }}/https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('') }}/https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/https://unpkg.com/bootstrap-show-password@1.3.0/dist/bootstrap-show-password.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
