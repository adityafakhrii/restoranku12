<!DOCTYPE html>
<html lang="en" data-bs-theme="light"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restoranku</title>
    <link rel="stylesheet" crossorigin="" href="{{ asset('assets/admin/compiled/css/app.css') }}">
    <link rel="stylesheet" crossorigin="" href="{{ asset('assets/admin/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" crossorigin="" href="{{ asset('assets/admin/compiled/css/auth.css') }}">
    <link rel="icon" href="https://apps.codepolitan.com/sites/learn/uploads/original/2/logo-codepolitan-originals.png" type="image/x-icon">
</head>

<body>
    <script src="{{ asset('assets/admin/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">

                    </div>
                    <h1 class="auth-title">Log in Restoranku</h1>
                    <p class="auth-subtitle mb-5">Silakan masuk untuk mengelola layanan Restoranku.</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Email" name="email" :value="old('email')" required autofocus autocomplete="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" require autocomplete="current-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>
    </div>
</body>
</html>
