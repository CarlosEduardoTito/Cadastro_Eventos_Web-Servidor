<?php

namespace App\Models;

use App\Config\Database;

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
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("
            SELECT 
                r.id,
                r.quantidade AS ingressos_reservados,
                e.nome AS evento,
                e.data,
                e.hora
            FROM reservas r
            JOIN eventos e ON r.evento_id = e.id
            WHERE r.usuario_id = ?
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }

    public static function criar($usuario_id, $evento_id, $quantidade) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("INSERT INTO reservas (usuario_id, evento_id, quantidade) VALUES (?, ?, ?)");
        $stmt->execute([$usuario_id, $evento_id, $quantidade]);
    }

    public static function buscarPorId($reserva_id) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("SELECT * FROM reservas WHERE id = ?");
        $stmt->execute([$reserva_id]);
        return $stmt->fetch();
    }

    public static function cancelar($reserva_id) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("DELETE FROM reservas WHERE id = ?");
        $stmt->execute([$reserva_id]);
    }
}
