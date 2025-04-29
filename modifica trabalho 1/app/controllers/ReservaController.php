<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once _DIR_ . '/../models/Reserva.php';
require_once _DIR_ . '/../models/Evento.php';

class ReservaController {
    public function reservar($usuario_id, $evento_id, $quantidade) {
        if ($quantidade <= 0) {
            $_SESSION['erro'] = "A quantidade de ingressos deve ser maior que zero.";
            header("Location: /trabalho1/public/index.php?action=reservar&id=" . $evento_id);
            exit;
        }
    
        foreach ($_SESSION['eventos'] as &$event) {
            if ($event['id'] == $evento_id) {
                $evento = &$event;
                break;
            }
        }
    
        if (!$evento) {
            $_SESSION['erro'] = "Evento inválido.";
            header("Location: /trabalho1/public/index.php?action=listar_eventos");
            exit;
        }
    
        if ($evento['ingressos_disponiveis'] < $quantidade) {
            $_SESSION['erro'] = "Ingressos insuficientes.";
            header("Location: /trabalho1/public/index.php?action=reservar&id=" . $evento_id);
            exit;
        }
    
        $reserva = [
            'id' => uniqid(),
            'usuario_id' => $usuario_id,
            'evento' => $evento['nome'],
            'evento_id' => $evento_id,
            'ingressos_reservados' => $quantidade,
            'data' => $evento['data'],
            'hora' => $evento['hora']
        ];
    
        if (!isset($_SESSION['reservas'])) {
            $_SESSION['reservas'] = [];
        }
        $_SESSION['reservas'][] = $reserva;
    
        $evento['ingressos_disponiveis'] -= $quantidade;
    
        $_SESSION['mensagem'] = "Reserva feita com sucesso!";
        header("Location: /trabalho1/public/index.php?action=minhas_reservas");
        exit;
    }

    public function minhasReservas($usuario_id) {
        if (!isset($_SESSION['reservas'])) {
            $_SESSION['reservas'] = []; 
        }
        $minhasReservas = array_filter($_SESSION['reservas'], function($reserva) use ($usuario_id) {
            return $reserva['usuario_id'] === $usuario_id; 
        });

        return $minhasReservas;
    }

    public function cancelar($reserva_id) {
        foreach ($_SESSION['reservas'] as $key => $reserva) {
            if ($reserva['id'] === $reserva_id) {
                foreach ($_SESSION['eventos'] as &$evento) {
                    if ($evento['id'] === $reserva['evento_id']) {
                        $evento['ingressos_disponiveis'] += $reserva['ingressos_reservados'];
                        break;
                    }
                }
                unset($_SESSION['reservas'][$key]);

                $_SESSION['mensagem'] = "Reserva cancelada com sucesso!";
                header("Location: /trabalho1/public/index.php?action=minhas_reservas");
                exit;
            }
        }

        $_SESSION['erro'] = "Reserva não encontrada.";
        header("Location: /trabalho1/public/index.php?action=minhas_reservas");
        exit;
    }
}
?>
