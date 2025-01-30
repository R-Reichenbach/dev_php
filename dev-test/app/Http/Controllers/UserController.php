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
            'email' => 'required|email|unique:contas_usuario,email', 
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

            
            return redirect('/login')->with('success', 'User registered successfully! log in.');

        } catch (\Exception $e) {
           
            return redirect()->back()->with('error', 'Erro: ' . $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

       
        $user = User::where('email', $request->email)->first();

      
        if ($user && Hash::check($request->password, $user->password)) {
           
            auth()->login($user);

            if (auth()->check()) {
                
                return redirect()->route('home')->with('success', 'Welcome back!');
            }
        }

        
        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }
}
