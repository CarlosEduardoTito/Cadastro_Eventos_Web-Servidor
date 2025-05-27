<?php

namespace App\Controllers;

use App\Models\Usuario;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AuthController {
    public function login($email, $senha) {
        $usuario = Usuario::encontrarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'email' => $usuario['email'],
                'nome' => $usuario['nome']
            ];
            header("Location: /trabalho2/public/menu");
            exit;
        } else {
            $this->setErrorAndRedirect("Email ou senha inválidos.", "login");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /trabalho2/public/login");
        exit;
    }

    public function cadastrar($nome, $email, $senha) {
        if (!Usuario::criar($nome, $email, $senha)) {
            $this->setErrorAndRedirect($_SESSION['erro'] ?? "Erro ao cadastrar.", "cadastrar");
        }
        $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
        header("Location: /trabalho2/public/login");
        exit;
    }

    private function setErrorAndRedirect($message, $url) {
        $_SESSION['erro'] = $message;
        header("Location: /trabalho2/public/$url");
        exit;
    }
}