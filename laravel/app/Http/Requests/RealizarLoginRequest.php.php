<?php

namespace App\Http\Requests;
use App\Contracts\RequestValidationInterface;
use App\Exceptions\ParametrosInvalidosException;
use App\Helpers\Validator;

class RealizarLoginRequest implements RequestValidationInterface
{
    public static function validate(array $credentials) : void {
        $email = $credentials['email'] ?? '';
        $password = $credentials['password'] ?? '';

        if(!Validator::isValidPassword($password)) {
            throw new ParametrosInvalidosException("Senha deve atender as devidas regras: Pelo menos 1 número, 1 letra maiúscula, 1 letra minúscula, 1 caractere especial e ser entre 6 e 16 caracteres.", [], "WEB", "login/login");
        }

        if(empty($login)) {
            throw new ParametrosInvalidosException("Login invalido.", ["Login enviado vazio."], "WEB", "login/login");
        }
    }
}