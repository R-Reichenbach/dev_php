<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
{
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:contas_usuario',
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return redirect()->back()->with('error', 'Failed to create user');
        }

        return redirect()->back()->with('success', 'User successfully registered!');
    } catch (\Exception $e) {

        return redirect()->back()->with('error', 'Erro: ' . $e->getMessage());
    }
}

public function login(Request $request)
{
    // Validação das entradas
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    // Verificar se o usuário existe
    $user = User::where('email', $request->email)->first();

    // Verificar se a senha corresponde
    if ($user && Hash::check($request->password, $user->password)) {
        // Autenticar o usuário
        auth()->login($user);
        
        if (auth()->check()) {
            return redirect()->route('home')->with('success', 'Bem-vindo de volta!');
        }
    }

    // Se falhar, retornar com erro
    return back()->withErrors(['email' => 'Credenciais inválidas.']);
}


}
