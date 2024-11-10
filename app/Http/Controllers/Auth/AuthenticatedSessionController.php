<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los campos de entrada
        $request->validate([
            'nit' => ['required', 'string', 'max:12', 'regex:/^\d+$/'],  // NIT: obligatorio, solo números
            'name' => ['required', 'string', 'max:255'],  // Nombre: obligatorio
            'password' => ['required', 'string'],  // Contraseña: obligatorio
            'g-recaptcha-response' => 'required|captcha',  // Agrega esta línea para validar el CAPTCHA
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt(['nit' => $request->nit, 'name' => $request->name, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Redireccionar a la página deseada después de iniciar sesión
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // Si la autenticación falla, redirigir con un error
        return back()->withErrors([
            'nit' => 'El NIT, nombre o contraseña no son correctos.',
        ])->onlyInput('nit');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
