<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        body {
            background-image: url("{{ asset('images/macos.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    <title>Inicio de sesión - República Celular</title>
</head>

<body>
    <div class="login">
        <div class="form">
            <div class="logo-container">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo">
            </div>
            <form method="POST" action="{{ route('inicio.sesion') }}">
                @csrf
                <h2>Inicio de sesión</h2>
                <div class="form-group row">
                    <label for="email">{{ __('Correo electrónico') }}</label>

                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="label-pass" for="password">{{ __('Contraseña') }}</label>

                    <div>
                        <div class="password-input-container">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            <img class="eye" id="eye-icon" src="{{ asset('images/cerrado.svg') }}"
                                onclick="togglePasswordVisibility()" />
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button class="animated-button" type="submit">Ingresar</button>
                <div class="res-password">
                    <a href="#" class="res-password">¿Olvidaste la
                        contraseña?</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Scripts --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.src = "{{ asset('images/abierto.svg') }}";
            } else {
                passwordInput.type = "password";
                eyeIcon.src = "{{ asset('images/cerrado.svg') }}";
            }
        }
    </script>
</body>

</html>
