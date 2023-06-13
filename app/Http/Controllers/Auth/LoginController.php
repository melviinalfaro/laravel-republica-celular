<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('mi-cuenta');
    }

    public function handle($request, $next)
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        }

        return $next($request);
    }
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin');
        } else {
            if (!User::where('email', $email)->exists()) {
                $errors['email'] = 'El correo es incorrecto';
            } elseif (!Auth::attempt(['password' => $password])) {
                $errors['password'] = 'La contraseña es incorrecta';
            }

            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('inicio'));
    }
}
