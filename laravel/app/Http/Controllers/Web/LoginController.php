<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests\RealizarLoginRequest;
use App\Models\UserModel;


class LoginController extends Controller
{
    //

    public function loginView() {
        if (Auth::guard('web')->check()) {
            return redirect()->route('home.home');
        } else {
            return view('login/login');
        }
    }


    public function realizarLogin(Request $request)
    {
        // Captura os valores diretamente do Request
        $credentials = [
            'email' => $request->email ?? '', // Campo login é obrigatório
            'password' => $request->password ?? '', // Campo senha é obrigatório
        ];
        RealizarLoginRequest::validate($credentials);

        // Autenticando o usuário com as credenciais
        if (Auth::guard('web')->attempt([
            'email' => $credentials['email'], // Campo email no banco
            'password' => $credentials['password'], // Senha informada
        ])) {
            // Regenera a sessão após autenticação bem-sucedida (segurança)
            $request->session()->regenerate();

            // Obter o usuário atualmente autenticado
            $user = Auth::guard('web')->user();
            
            // Verificar se o usuário é admin (conforme seu método estático)
            // if (UserModel::isAdmin($user->id)) {
            //     return redirect()->route('home.home'); // Redireciona para rota home
            // } else {
            //     // Usuário não autorizado para o sistema
            //     return view('login/login', ['erro' => 'Você não tem permissão para acessar.']);
            // }
            return redirect()->route('home.home');
        } else {
            // Caso o login falhe, retorna para a tela de login com mensagem de erro
            return view('login/login', ['erro' => 'Credenciais incorretas.']);
        }
    }
}