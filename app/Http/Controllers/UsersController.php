<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Trás todas as informações menos as informações do token
        $data = $request->except(['_token']);

        // Realiza o Hash da senha
        $data['password'] = Hash::make($data['password']);

        // Cria o usuário
        $user = User::create($data);

        // Autentica o usuário
        Auth::login($user);

        // Redireciona caso a autenticação seja bem sucedida
        return to_route("series.index");
    }
}