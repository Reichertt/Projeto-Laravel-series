<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController 
{
    public function index()
    {
        return view("login.index");
    }

    // attempt método que espera as credenciais de login
    public function store(Request $request)
    {
        // Se não houver usuário autenticado, a mensagem de erro é mostrada.
        if(!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->withErrors(['Usuário ou senha inválidos']);
        }
        return to_route('series.index');
    }

    public function destroy()
    {
        Auth::logout();

        return to_route('login');
    }
}

// Quando chamamos o Auth::attempt passando as credenciais por parâmetro, o que o sistema vai fazer é utilizar o provider de usuários para tentar encontrar o usuário referente as credenciais enviadas. O provider padrão é o Eloquent, ou seja, nós tentamos buscar o usuário no banco de dados.

// Ao chamar o método Auth::check ela verifica no guard configurado se há algum usuário presente. O guard padrão é session que armazena o usuário em sessão.