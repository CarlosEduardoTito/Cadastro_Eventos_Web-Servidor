<?php

class Usuario {
    private $nome;
    private $email;
    private $senha;

    public function __construct($nome, $email, $senha) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public static function criar($nome, $email, $senha) {
        if (!isset($_SESSION['usuarios'])) {
            $_SESSION['usuarios'] = [];
        }

        foreach ($_SESSION['usuarios'] as $usuario) {
            if ($usuario['email'] === $email) {
                $_SESSION['erro'] = "Usuário já cadastrado com este email.";
                return false;
            }
        }

        $novoUsuario = new self($nome, $email, $senha);
        $_SESSION['usuarios'][] = [
            'nome' => $novoUsuario->nome,
            'email' => $novoUsuario->email,
            'senha' => $novoUsuario->senha
        ];
        return true;
    }

    public static function encontrarPorEmail($email) {
        if (isset($_SESSION['usuarios'])) {
            foreach ($_SESSION['usuarios'] as $usuario) {
                if ($usuario['email'] === $email) {
                    return $usuario;
                }
            }
        }
        return null;
    }
}