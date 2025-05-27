<?php
require_once __DIR__ . '/../config/database.php';

class Evento {
    public static function criar($dados) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("INSERT INTO eventos (nome, descricao, data, hora, localizacao, ingressos_disponiveis, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $dados['nome'],
            $dados['descricao'],
            $dados['data'],
            $dados['hora'],
            $dados['localizacao'],
            $dados['ingressos'],
            $dados['usuario_id']
        ]);
    }

    public static function listarTodos() {
        $pdo = Database::conectar();
        $stmt = $pdo->query("SELECT * FROM eventos");
        return $stmt->fetchAll();
    }

    public static function buscarPorId($id) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("SELECT * FROM eventos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function excluir($id) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("DELETE FROM eventos WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function atualizarIngressos($id, $novoTotal) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("UPDATE eventos SET ingressos_disponiveis = ? WHERE id = ?");
        $stmt->execute([$novoTotal, $id]);
    }

    public static function listarPorUsuario($usuario_id) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("SELECT * FROM eventos WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }

    public static function atualizar($id, $dados) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("UPDATE eventos SET nome=?, descricao=?, data=?, hora=?, localizacao=?, ingressos_disponiveis=? WHERE id=? AND usuario_id=?");
        return $stmt->execute([
            $dados['nome'],
            $dados['descricao'],
            $dados['data'],
            $dados['hora'],
            $dados['localizacao'],
            $dados['ingressos'],
            $id,
            $dados['usuario_id']
        ]);
    }
}
