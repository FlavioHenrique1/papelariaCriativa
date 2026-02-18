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
        $retorno = $this->estoque->inserirEstoqueAtual($insumoId, $quantidade, $valorUnitario, $tipo);
        if($retorno['success']){
            $saldo=$retorno['dados'];
            $retorno=$this->db->insert([
                'insumo_id'    => $insumoId,
                'quantidade'   => $quantidade,
                'custo_medio'  => $valorUnitario,
                'origem' => $origem,
                'origemId' => $origemId,
                'saldo_resultante' => $saldo,
                'tipo'=>$tipo
            ]);
            $arrResponse=[
                'message' =>"Dados Inseridos com sucesso!",
                'success' => true,
                'dados'=>$retorno
            ];
            return $arrResponse;
        }
        return $retorno;
    }
    
    #Listar Histórico
    public function listarhistorico($id=null){
        return $this->db->getByInsumo($id);
    }

    #Ajuste de estoque
    public function justehistorico($insumoId, $quantidade, $tipo = 'ajuste', $origem='ajuste'){
            
            $b=$this->estoque->getEstoque($insumoId);
            $this->estoque->ajusteEstoque(
                $b['id'],
                $quantidade,
                $b['custo_medio']
            );
        $this->db->insert([
            'insumo_id'    => $insumoId,
            'quantidade'   => $quantidade,
            'custo_medio'  => "",
            'origem' => $origem,
            'origemId' => "",
            'saldo_resultante' => $quantidade,
            'tipo'=>$tipo
        ]);
        $arrResponse=[
            'message' =>"Estoque ajustado com sucesso!",
            'success' => true,
            "erros"=>null
        ];
        return $arrResponse;
    }
}
