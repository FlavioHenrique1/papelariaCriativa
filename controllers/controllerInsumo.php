<?php
$valInsumo=new Classes\ClassInsumos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dados = [
        'id'        => $_POST['id']        ?? null,
        'nome'      => $_POST['nome']      ?? '',
        'descricao' => $_POST['descricao'] ?? '',
        'estoque'   => $_POST['estoque']   ?? ''
    ];

    if (empty($dados['nome'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Nome é obrigatório'
        ]);
        exit;
    }

    if (empty($dados['id'])) {
        // INSERT
        $valInsumo->inserirInsumos($dados);
    } else {
        // UPDATE

    }
}
