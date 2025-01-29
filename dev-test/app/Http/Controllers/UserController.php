<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contas_usuario,email', // Usando a validação do Laravel para garantir a unicidade
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Criação do usuário
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if (!$user) {
                return redirect()->back()->with('error', 'Failed to create user');
            }

            // Redireciona para a página de login com mensagem de sucesso
            return redirect('/login')->with('success', 'User registered successfully! log in.');

        } catch (\Exception $e) {
            // Em caso de erro, redireciona com a mensagem de erro
            return redirect()->back()->with('error', 'Erro: ' . $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        // Validação das entradas de login
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
                // Redireciona para a página inicial
                return redirect()->route('home')->with('success', 'Welcome back!');
            }
        }

        // Se falhar, retornar com erro
        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }
}
