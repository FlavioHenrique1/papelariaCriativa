<?php

namespace Classes;

use Models\ClassDbHistorico;
use Classes\ClassEstoque;

class ClassHistorico
{

    private $db;
    private $estoque;


    public function __construct()
    {
        $this->db = new ClassDbHistorico();
        $this->estoque = new ClassEstoque();
    }

    /**
     * Movimenta o estoque
     * $tipo = entrada | saida
     */
    public function movimentar($insumoId, $quantidade, $valorUnitario, $tipo = 'entrada', $origem, $origemId)
    {
        $saldo = $this->estoque->inserirEstoqueAtual($insumoId, $quantidade, $valorUnitario, $tipo);
        return $this->db->insert([
            'insumo_id'    => $insumoId,
            'quantidade'   => $quantidade,
            'custo_medio'  => $valorUnitario,
            'origem' => $origem,
            'origemId' => $origemId,
            'saldo_resultante' => $saldo,
            'tipo'=>$tipo
        ]);
    }
}
