<?php
use Classes\ClassCompras;
use Classes\ClassHistorico;

$valCompras = new ClassCompras();
$valEstoque=new ClassHistorico();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // action via POST (insert | list | delete | update)
    $action = $_POST['action'] ?? 'insert';

    // Normaliza valor monetário vindo do front
    $valorTotal = $valCompras->normalizarValor($_POST['total'] ?? '0');

    $dados = [
        'id'            => $_POST['id'] ?? null,
        'insumo'        => $_POST['insumo'] ?? null,
        'quantidade'    => $_POST['quantidade'] ?? 0,
        'valorUnitario' => $valCompras->normalizarValor($_POST['valorUnitario'] ?? '0'),
        'data'          => $_POST['data'] ?? date('Y-m-d'),
        'total'         => $valorTotal,
        'status'        => "Concluída"
    ];

    switch ($action) {

        case 'insert':
            $retorno=$valCompras->inserirComprasDb($dados);
            $valEstoque->movimentar($dados['insumo'],$dados['quantidade'],$dados['valorUnitario'],"entrada","compra",$retorno['idCompra']);

            echo json_encode($retorno);
        break;

        case 'list':
            echo json_encode(
                $valCompras->listarCompras($dados['id'])
            );
        break;

        case 'delete':
            if ($dados['id']) {
                // echo($dados['id']);
                echo $valCompras->apagarCompras($dados['id']);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'ID não informado'
                ]);
            }
        break;

        case 'update':
            if ($dados['id']) {
                // echo $valCompras->atualizarCompra($dados);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'ID necessário para atualizar'
                ]);
            }
        break;

        default:
            echo json_encode([
                'success' => false,
                'message' => 'Ação inválida'
            ]);
    }
}
