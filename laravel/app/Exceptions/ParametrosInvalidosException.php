<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Http;

class ParametrosInvalidosException extends Exception
{
    protected $erros;
    protected $ambiente;
    protected $redirecionamento;

    public function __construct(string $message = 'Parâmetros inválidos ou ausentes.', array $erros = [], $ambiente = "API", $redirecionamento = "home")
    {
        parent::__construct($message);
        $this->erros = $erros;
        $this->ambiente = $ambiente;
        $this->redirecionamento = $redirecionamento;
    }

    public function render($request)
    {
        if($this->ambiente == "WEB") {
            return view($this->redirecionamento, [
                'erro' => $this->message
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => $this->getMessage(),
                'erros' => $this->erros,
                'dados' => []
            ], 422); 
        }
    }
}

?>