<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $datos = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($datos)) {
            return back()->withErrors([
                'email' => 'El correo o la contraseña son incorrectos.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->isTeacher()) {
            return redirect()->route('teacher.students.index');
        }

        if ($user->isStudent()) {
            return redirect()->route('student.dashboard');
        }

        Auth::logout();

        return redirect()->route('login')->withErrors([
            'email' => 'El rol del usuario no es válido.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with(
            'success',
            'Sesión cerrada correctamente.'
        );
    }
}
