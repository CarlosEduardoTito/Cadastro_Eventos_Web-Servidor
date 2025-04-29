<?php

class Reserva {
    public $usuario_id;
    public $evento_id;
    public $quantidade;

    public function __construct($usuario_id, $evento_id, $quantidade) {
        $this->usuario_id = $usuario_id;
        $this->evento_id = $evento_id;
        $this->quantidade = $quantidade;
    }

    public static function listarPorUsuario($usuario_id) {
        if (!isset($_SESSION['reservas'])) {
            return [];
        }
        return array_filter($_SESSION['reservas'], function($reserva) use ($usuario_id) {
            return $reserva->usuario_id === $usuario_id;
        });
    }

    public static function cancelar($evento_id, $usuario_id) {
        if (isset($_SESSION['reservas'])) {
            foreach ($_SESSION['reservas'] as $key => $reserva) {
                if ($reserva->evento_id === $evento_id && $reserva->usuario_id === $usuario_id) {
                    unset($_SESSION['reservas'][$key]);
                    return true;
                }
            }
        }
        return false;
    }

    public static function criar($usuario_id, $evento_id, $quantidade) {
        if (!isset($_SESSION['reservas'])) {
            $_SESSION['reservas'] = [];
        }
        $reserva = new Reserva($usuario_id, $evento_id, $quantidade);
        $_SESSION['reservas'][] = $reserva;
    }
}
