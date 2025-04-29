<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class EventoController {
    public function criar($dados) {
    
        if (empty($dados['nome']) || empty($dados['ingressos'])) {
        $_SESSION['erro'] = "Nome e ingressos são obrigatórios.";
        header("Location: /trabalho1/public/index.php?action=criar_evento");
        exit;
    }

    if ($dados['ingressos'] < 0) {
        $_SESSION['erro'] = "A quantidade de ingressos não pode ser negativa.";
        header("Location: /trabalho1/public/index.php?action=criar_evento");
        exit;
    }

    $evento = [
        'id' => uniqid(),
        'nome' => $dados['nome'],
        'descricao' => $dados['descricao'],
        'data' => date('Y-m-d', strtotime(str_replace('/', '-', $dados['data']))),
        'hora' => $dados['hora'],
        'localizacao' => $dados['localizacao'],
        'ingressos_disponiveis' => $dados['ingressos']
    ];

    $_SESSION['eventos'][] = $evento;
    $_SESSION['mensagem'] = "Evento criado com sucesso!";
    header("Location: /trabalho1/public/index.php?action=listar_eventos");
    exit;
}
    
        $evento = [
            'id' => uniqid(),
            'nome' => $dados['nome'],
            'descricao' => $dados['descricao'],
            'data' => date('Y-m-d', strtotime(str_replace('/', '-', $dados['data']))),
            'hora' => $dados['hora'],
            'localizacao' => $dados['localizacao'],
            'ingressos_disponiveis' => $dados['ingressos']
        ];
    
        $_SESSION['eventos'][] = $evento;
        $_SESSION['mensagem'] = "Evento criado com sucesso!";
        header("Location: /trabalho1/public/index.php?action=listar_eventos");
        exit;
    }

    public function listar() {
        return $_SESSION['eventos'] ?? [];
    }

    public function excluir($id) {
        if (isset($_SESSION['eventos'])) {
            foreach ($_SESSION['eventos'] as $key => $evento) {
                if ($evento['id'] === $id) {
                    unset($_SESSION['eventos'][$key]);
                    $_SESSION['mensagem'] = "Evento excluído com sucesso!";
                    return;
                }
            }
        }
        $_SESSION['erro'] = "Evento não encontrado.";
    }
}
?>
