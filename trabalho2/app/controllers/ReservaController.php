<?php

namespace App\Controllers;

use App\Models\Reserva;
use App\Models\Evento;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class ReservaController {
    public function reservar($usuario_id, $evento_id, $quantidade) {
        $evento = Evento::buscarPorId($evento_id);
        if (!$evento || $evento['ingressos_disponiveis'] < $quantidade) {
            $_SESSION['erro'] = "Ingressos insuficientes.";
            header("Location: /trabalho2/public/eventos");
            exit;
        }
        Reserva::criar($usuario_id, $evento_id, $quantidade);
        Evento::atualizarIngressos($evento_id, $evento['ingressos_disponiveis'] - $quantidade);
        $_SESSION['mensagem'] = "Reserva realizada!";
        header("Location: /trabalho2/public/minhas_reservas");
        exit;
    }

    public function minhasReservas($usuario_id) {
        return Reserva::listarPorUsuario($usuario_id);
    }

    public function cancelar($reserva_id) {
        $reserva = Reserva::buscarPorId($reserva_id);
        if (!$reserva) {
            $_SESSION['erro'] = "Reserva não encontrada.";
            header("Location: /trabalho2/public/minhas_reservas");
            exit;
        }
        Evento::atualizarIngressos($reserva['evento_id'], Evento::buscarPorId($reserva['evento_id'])['ingressos_disponiveis'] + $reserva['quantidade']);
        Reserva::cancelar($reserva_id);
        $_SESSION['mensagem'] = "Reserva cancelada com sucesso!";
        header("Location: /trabalho2/public/minhas_reservas");
        exit;
    }
}
?>
