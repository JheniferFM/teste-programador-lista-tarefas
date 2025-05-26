<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Exibe o formulário de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Processa o registro do usuário.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1) Se já houver alguém logado, encerre a sessão antiga
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // 2) Validação dos dados
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 3) Criação do usuário
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 4) Dispara evento (ex: para e-mail verification)
        event(new Registered($user));

        // 5) Login automático do novo usuário
        Auth::login($user);

        // 6) Regenera a sessão para evitar fixação de sessão
        $request->session()->regenerate();

        // 7) Redireciona para a lista de tarefas
        return redirect()->route('tasks.index');
    }
}
