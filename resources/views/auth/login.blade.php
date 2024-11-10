<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
        }
        .container {
            display: flex;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        .left {
            background-color: #02295f;
            color: white;
            padding: 40px;
            width: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .left img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .left h2 {
            margin-bottom: 10px;
            font-size: 20px;
            text-align: center;
        }
        .left p {
            text-align: center;
            font-size: 16px;
        }
        .right {
            width: 60%;
            padding: 40px;
        }
        .right h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .captcha {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .captcha img {
            margin-right: 10px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #02295f;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #004080;
        }
        .footer-link {
            margin-top: 20px;
            text-align: center;
        }
        .footer-link a {
            color: #004080;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="https://login.impuestos.gob.bo/resources/etrf1/login/siat/img/logo-siat-bolivia.png" alt="Logo">
            <h2>Sistema Integrado de Administración Tributaria</h2>
            <p>SIAT</p>
        </div>
        <div class="right">
            <h2>¡Bienvenido/a!</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulario de login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- NIT -->
                <div class="form-group">
                    <x-input-label for="nit" :value="__('NIT')" />
                    <x-text-input id="nit" class="block mt-1 w-full" type="text" name="nit" :value="old('nit')" required autofocus />
                    <x-input-error :messages="$errors->get('nit')" class="mt-2" />
                </div>

                <!-- Nombre de Usuario -->
                <div class="form-group">
                    <x-input-label for="name" :value="__('Nombre de Usuario')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                

                <!-- Contraseña -->
                <div class="form-group mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

<!-- CAPTCHA -->
                <div class="form-group mt-4">
                    <div class="g-recaptcha" data-sitekey="6LeJXlcqAAAAAIcpN6kaauiwr9raE939kDe24gJV" data-action="LOGIN"></div>
                    @error('g-recaptcha-response')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Enlaces y botón de enviar -->
                <div class="flex items-center justify-end mt-4">
                    

                    <button type="submit" class="btn w-100" style="background-color: #02295f; border-color: #02295f; color: white; font-weight: bold;">
                        {{ __('INGRESAR') }}
                    </button>
                    
                </div>
            </form>

            <div class="footer-link">
                <a href="https://siat.impuestos.gob.bo/v2/launcher">Autenticarse SIAT En Línea v2</a>
            </div>
        </div>
    </div>

    <!-- Scripts para reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
