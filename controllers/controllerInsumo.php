<?php
$valInsumo = new Classes\ClassInsumos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dados = [
        'id'        => $_POST['id']        ?? null,
        'nome'      => $_POST['nome']      ?? '',
        'descricao' => $_POST['descricao'] ?? '',
        'estoque'   => isset($_POST['estoque']) ? (int)$_POST['estoque'] : 0
    ];

    $action = $_POST['action'] ?? '';

    if (empty($dados['id']) && empty($action)) {
        // INSERT
        echo $valInsumo->inserirInsumos($dados);

    } elseif ($action === 'list') {
        // SELECT
        echo $valInsumo->selectInsumos($dados['id']);

    } elseif ($action === 'delete') {
        // DELETE
        if ($dados['id']) {
            $excluido = $valInsumo->excluirInsumo($dados['id']); // método que você deve ter na sua classe
            echo($excluido);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID do insumo não informado.']);
        }

    } else {

        // UPDATE
        if ($dados['id']) {
           echo $valInsumo->atualizarInsumo($dados);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID necessário para atualizar.']);
        }
    }
}
