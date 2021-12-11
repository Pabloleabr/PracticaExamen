<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * loginForm
     * te muestra la vista login
     * @return void
     */
    public function loginForm()
    {
        return view('login');
    }

    /**
     * login
     * valida los datos del login y compruean si existen en la base de datos
     * para loguearte
     * @return void
     */
    public function login()
    {
        $validados = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = DB::table('users')->where('email', $validados['email']);

        if ($usuario->exists()) {
            $usuario = ($usuario->get())[0];

            if (password_verify($validados['password'], $usuario->password)) {
                session(['usuario' => $validados['email']]);
                return redirect('/')->with('success', 'El usuario ha iniciado sesión.');
            }
        }

        return redirect()->back()->with('error', 'Usuario o contraseña incorrectos.');
    }

    /**
     * logout
     * te desloguea si estas logueado
     * @return void
     */
    public function logout()
    {
        if($this->logueado()) {
            session()->forget('usuario');
        }
        return redirect('/')->with('success', 'has hecho logout correctamente');
    }

    /**
     * logueado
     * comprueba si estas logueado
     * @return bool
     */
    public static function logueado()
    {
        return request()->session()->has('usuario');
    }
}
