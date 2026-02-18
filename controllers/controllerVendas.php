<?php
session_start();

use Classes\ClassHistorico;
use Classes\ClassValidateVendas;

$valVendas = new ClassValidateVendas();


// $userId=$_SESSION['id'];
if (!isset($_POST['servico_id']) || empty($_POST['servico_id'])) {
    echo json_encode([
        "status" => "erro",
        "message" => "Favor incluir itens para continuar na venda!"
    ]);
    exit;
}

$userId=5;

$action = $_POST['action'] ?? '';
    $valorTotal = 0;

    foreach ($_POST['servico_id'] as $i => $servicoId) {
        $valorTotal += $_POST['valor_total'][$i];
    }

    $desconto = (float) ($_POST['desconto'] ?? 0);
    $valorTotal = (float) $valorTotal;

    $valorFinal = $valorTotal - $desconto;

$dados = [
    'id'            => $_POST['id'] ?? null,
    'cliente_nome'        => $_POST['cliente_nome'] ?? null,
    'cliente_contato'    => $_POST['cliente_contato'] ?? null,
    'valor_pago' => (float) ($_POST['valor_pago'] ?? '0'),
    'desconto'          => $_POST['desconto'] ?? '0',
    'forma_pagamento'         => $_POST['forma_pagamento'] ?? null,
    'valorTotal'         => $valorFinal,
    'status'        => "Concluída",
];

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && empty($action)) {
    // 1️⃣ Inserir venda
    $dadosIncVendas = $valVendas->inserirVendasDb($userId,$dados);

    if($dadosIncVendas['success']== true){
        $idVenda=$dadosIncVendas['idvendas'];
        foreach ($_POST['servico_id'] as $i => $servicoId) {
            $qtd   = $_POST['quantidade'][$i];
            $custoUnit  = $_POST['valor_unitario'][$i];
            $total = $_POST['valor_total'][$i];
            $servico_id = $_POST['servico_id'][$i];
            
            $dadosItens=[
                'idVendas'  => $idVenda,
                'servico_id'  => $servico_id,
                'qtd'  => $qtd,
                'custoUnit'  => $custoUnit,
                'total' =>$total
            ];

            // insert vendas_itens
            echo json_encode($valVendas->inserirItensVendasDb($dadosItens));
        }
    }

}
