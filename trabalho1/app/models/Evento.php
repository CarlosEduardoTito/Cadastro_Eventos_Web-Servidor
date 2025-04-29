<?php

class Evento {
    private static $eventos = [];

    public static function criar($dados) {
        $evento = [
            'id' => count(self::$eventos) + 1,
            'nome' => $dados['nome'],
            'descricao' => $dados['descricao'],
            'data' => $dados['data'],
            'hora' => $dados['hora'],
            'localizacao' => $dados['localizacao'],
            'ingressos_disponiveis' => $dados['ingressos']
        ];
        self::$eventos[] = $evento;
        $_SESSION['eventos'] = self::$eventos;
    }

    public static function listarTodos() {
        return $_SESSION['eventos'] ?? [];
    }

    public static function buscarPorId($id) {
        foreach (self::$eventos as $evento) {
            if ($evento['id'] == $id) {
                return $evento;
            }
        }
        return null;
    }

    public static function excluir($id) {
        foreach (self::$eventos as $key => $evento) {
            if ($evento['id'] == $id) {
                unset(self::$eventos[$key]);
                $_SESSION['eventos'] = self::$eventos;
                return true;
            }
        }
        return false;
    }
}
