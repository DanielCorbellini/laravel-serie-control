<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
        // Validação dos campos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Obtendo apenas email e password
        $credentials = $request->only('email', 'password');

        // Tenta autenticar o usuário com as credenciais fornecidas
        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida
            return redirect()->intended('/'); // Redireciona para uma página após autenticação
        } else {
            // Falha na autenticação
            return back()->withErrors(['email' => 'Credenciais incorretas']);
        }
    }

    public function destroy()
    {
        Auth::logout();

        return to_route('login');
    }
}
