<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AuthController {
    public function login($email, $senha) {
        $usuarios = $_SESSION['usuarios'] ?? [];
        if (isset($usuarios[$email]) && $usuarios[$email]['senha'] === $senha) {
            $_SESSION['usuario'] = [
                'id' => $usuarios[$email]['id'],
                'email' => $email,
                'nome' => $usuarios[$email]['nome']
            ];
            header("Location: /trabalho1/public/index.php?action=menu");
        } else {
            $this->setErrorAndRedirect("Email ou senha inválidos.", "login");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /trabalho1/public/index.php?action=login");
        exit;
    }

    public function cadastrar($nome, $email, $senha) {
        $usuarios = $_SESSION['usuarios'] ?? [];
        if (isset($usuarios[$email])) {
            $this->setErrorAndRedirect("Usuário já cadastrado com este email.", "cadastrar");
        }

        $usuarios[$email] = [
            'id' => uniqid(),
            'nome' => $nome,
            'senha' => $senha
        ];
        $_SESSION['usuarios'] = $usuarios;

        $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
        header("Location: /trabalho1/public/index.php?action=login");
        exit;
    }

    private function setErrorAndRedirect($message, $action) {
        $_SESSION['erro'] = $message;
        header("Location: /trabalho1/public/index.php?action=$action");
        exit;
    }
}