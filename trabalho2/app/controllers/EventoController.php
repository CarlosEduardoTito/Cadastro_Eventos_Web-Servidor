<?php

namespace App\Controllers;

use App\Models\Evento;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class EventoController {
    public function criar($dados) {
        if (empty($dados['nome']) || empty($dados['ingressos'])) {
            $_SESSION['erro'] = "Nome e ingressos são obrigatórios.";
            header("Location: /trabalho2/public/criar_evento");
            exit;
        }
        $dados['usuario_id'] = $_SESSION['usuario']['id'];
        Evento::criar($dados);
        $_SESSION['mensagem'] = "Evento criado com sucesso!";
        header("Location: /trabalho2/public/eventos");
        exit;
    }

    public function listar() {
        return Evento::listarTodos();
    }

    public function meusEventos() {
        return Evento::listarPorUsuario($_SESSION['usuario']['id']);
    }

    public function editar($id, $dados) {
        $dados['usuario_id'] = $_SESSION['usuario']['id'];
        if (Evento::atualizar($id, $dados)) {
            $_SESSION['mensagem'] = "Evento atualizado!";
        } else {
            $_SESSION['erro'] = "Não autorizado ou evento não encontrado.";
        }
        header("Location: /trabalho2/public/meus_eventos");
        exit;
    }

    public function excluir($id) {
        $evento = Evento::buscarPorId($id);
        if ($evento && $evento['usuario_id'] == $_SESSION['usuario']['id']) {
            Evento::excluir($id);
            $_SESSION['mensagem'] = "Evento excluído!";
        } else {
            $_SESSION['erro'] = "Você não pode excluir este evento.";
        }
        header("Location: /trabalho2/public/meus_eventos");
        exit;
    }
}
?>
