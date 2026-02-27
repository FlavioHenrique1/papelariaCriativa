<?php
$valInsumo = new Classes\ClassInsumos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $dados = [
        'id'        => $_POST['id']        ?? null,
        'nome'      => $_POST['nome']      ?? '',
        'descricao' => $_POST['descricao'] ?? '',
        'tamanho' => $_POST['tamanho'] ?? '',
        'unidade_base' => $_POST['unidade_base'] ?? '',
        'estoqueMinimo' =>$_POST['estoqueMinimo'] ?? ''
    ];
    $action = $_POST['action'] ?? null;
    // echo $action;

    $unidades = $_POST['unidade_compra'] ?? [];
    $fatores  = $_POST['fator'] ?? [];

    if (empty($dados['id']) && empty($action)) {
        // INSERT
        $valInsumo->validarNome($dados['nome'],$dados['tamanho']);
        $valid=$valInsumo->validarCampos($_POST, [
            'nome' => 'Nome',
            'tamanho' => 'Tamanho',
            'unidade_base' => 'Unidade Base'
        ]);
        echo $valInsumo->inserirInsumos($dados,$unidades,$fatores);

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

    }elseif($action == 'getConversoes'){
        echo $valInsumo->getConversaoIns($dados['id']);
    }else {

        // UPDATE
        if ($dados['id']) {
           echo $valInsumo->atualizarInsumo($dados,$unidades,$fatores);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID necessário para atualizar.']);
        }
    }
}
