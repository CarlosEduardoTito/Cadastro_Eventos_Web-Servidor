<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    public function login($email, $senha) {
        $usuario = Usuario::encontrarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'email' => $usuario['email'],
                'nome' => $usuario['nome']
            ];
            header("Location: /trabalho2/menu");
            exit;
        } else {
            $this->setErrorAndRedirect("Email ou senha inválidos.", "login");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /trabalho2/login");
        exit;
    }

    public function cadastrar($nome, $email, $senha) {
        if (!Usuario::criar($nome, $email, $senha)) {
            $this->setErrorAndRedirect($_SESSION['erro'] ?? "Erro ao cadastrar.", "cadastrar");
        }
        $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
        header("Location: /trabalho2/login");
        exit;
    }

    private function setErrorAndRedirect($message, $url) {
        $_SESSION['erro'] = $message;
        header("Location: /trabalho2/$url");
        exit;
    }
}