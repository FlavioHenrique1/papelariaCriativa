<?php
$valServico = new Classes\ClassServicos();

$insumosId  = $_POST['insumo_nome'] ?? [];
$insumosQtd   = $_POST['insumo_qtd'] ?? [];

$dadosServicos = [
    'id'        => $_POST['id'] ?? '',
    'nomeServico'      => $_POST['nome_servico'] ?? '',
    'categoria' => $_POST['categoria'] ?? '',
    'descricao' => $_POST['descricao'] ?? '',
    'preco'   => $_POST['preco'] ?? 0,
    'status'   => $_POST['status'] ?? 'ativo',
];

$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && empty($action)) {
    $id =$valServico->validateServico($dadosServicos);
    for ($i = 0; $i < count($insumosId); $i++) {
        $idInsumo = $insumosId[$i];
        $qtdInsumo  = $insumosQtd[$i];
        $valServico->validateInsumos($id,$idInsumo,$qtdInsumo);
        // Insere cada insumo associado ao serviço

    }

}elseif ($action === 'list') {
    echo $dados=$valServico->getServicos();
}
