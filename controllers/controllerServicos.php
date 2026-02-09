<?php
$valServico = new Classes\ClassServicos();

$insumosId  = $_POST['insumo_nome'] ?? [];
$insumosQtd   = $_POST['insumo_qtd'] ?? [];

$dadosServicos = [
    'id'        => $_POST['id'] ?? '',
    'nomeServico' => $_POST['nome_servico'] ?? '',
    'categoria' => $_POST['categoria'] ?? '',
    'tamanho' => $_POST['tamanho'] ?? '',
    'descricao' => $_POST['descricao'] ?? '',
    'preco'   => $_POST['preco'] ?? 0,
    'status'   => $_POST['status'] ?? 'ativo',
];

$action = $_POST['action'] ?? '';

#VERIFICAR SE É UM LANÇAMENTO 
if ($_SERVER['REQUEST_METHOD'] === 'POST'  && empty($action)) {
    if (!empty($_POST['idservico'])) {
        $valServico->apagarInsumosServ($_POST['idservico']);
        $retorno= $valServico->editarServ($_POST['idservico'],$dadosServicos);
    } else {
        #lANÇAMENTO NO BD
        $retorno = $valServico->validateServico($dadosServicos);
    }
    if ($retorno['erros'] === true) {
        echo json_encode($retorno);
        exit;
    }
    for ($i = 0; $i < count($insumosId); $i++) {
        $valServico->validateInsumos(
            $retorno['data'],
            $insumosId[$i],
            $insumosQtd[$i]
        );
    }

    echo json_encode([
        'success' => true,
        'message' => 'Serviço cadastrado com sucesso'
    ]);
    exit;
} elseif ($action === 'list') {
    #verifica se é um select
    if (!empty($_POST['id'])) {
        echo $dados = $valServico->getServicos($dadosServicos['id']);
    } else {
        echo $dados = $valServico->getServicos();
    }
} elseif ($action === 'delete') {
    echo $valServico->apagarServicos($dadosServicos['id']);
}
