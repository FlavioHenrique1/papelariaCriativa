<?php
use Classes\ClassEstoque;
use Classes\ClassHistorico;


$valHistorico = new ClassHistorico();
$valEstoque= new ClassEstoque();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // action via POST (insert | list | delete | update)
    $action = $_POST['action'] ?? 'insert';
    $dados = [
        'insumo_id'            => $_POST['insumo_id'] ?? null,
        'quantidade'           => $_POST['quantidade'] ?? null,

    ];

    // Normaliza valor monetário vindo do front
    // $valorTotal = $valCompras->normalizarValor($_POST['total'] ?? '0');

    switch ($action) {

        case 'insert':
            // $retorno=$valCompras->inserirComprasDb($dados);
            // $valEstoque->movimentar($dados['insumo'],$dados['quantidade'],$dados['valorUnitario'],"entrada","compra",$retorno['idCompra']);
            // echo json_encode($retorno);
        break;

        case 'list':
            echo json_encode(
                $valEstoque->listarEstoque($dados['insumo_id'])
            );
        break;
        case 'historico':
            echo json_encode(
                $valHistorico->listarhistorico($dados['insumo_id'])
            );
        break;
        case 'ajuste':
            echo json_encode(
                $valHistorico->justehistorico($dados['insumo_id'],$dados['quantidade'])
            );
        break;
        case 'delete':
            if ($dados['id']) {
                // echo($dados['id']);
                // echo $valCompras->apagarCompras($dados['id']);
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
