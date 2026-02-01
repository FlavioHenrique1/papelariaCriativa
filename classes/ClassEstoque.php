<?php

namespace Classes;

use Models\ClassDbEstoque;

class ClassEstoque {

    private $dbEstoque;

    public function __construct()
    {
        $this->dbEstoque = new ClassDbEstoque();
    }

    // LISTAR ESTOQUE
    public function listarEstoque($id=null){
        
        $arrResponse=[
            'message' =>"Daodos inseridos com sucesso!",
            'success' => true,
            "erros"=>null
        ];
        $dados=$this->dbEstoque->getByInsumo($id);
        return json_encode($dados);
    }

    public function ajusteEstoque($estoqueId,$novaQtd,$novoCusto){
        $this->dbEstoque->update(
            $estoqueId,
            $novaQtd,
            $novoCusto
        );
    }

    public function getEstoque($insumoId) {
        return $this->dbEstoque->getByInsumo($insumoId);
    }

    /**
     * Movimenta o estoque
     * $tipo = entrada | saida
     */
    public function inserirEstoqueAtual($insumoId, $quantidade, $valorUnitario,$tipo="entrada")
    {
        $estoque = $this->getEstoque($insumoId);
        if (!$estoque) {
            $saldo_resultante=$quantidade;
            $this->dbEstoque->insert([
                'insumo_id'    => $insumoId,
                'quantidade'   => $quantidade,
                'custo_medio'  => $valorUnitario,
            ]);
            return $saldo_resultante;
        }else{
            // 🔹 EXISTE → atualiza
            $qtdAtual   = (int)$estoque['quantidade'];
            $custoAtual = (float)$estoque['custo_medio'];
            
            if ($tipo === 'entrada') {
    
                $novaQtd = $qtdAtual + $quantidade;
    
                $novoCusto = (
                    ($qtdAtual * $custoAtual) + ($quantidade * $valorUnitario)
                ) / $novaQtd;
    
            } else {
                // SAÍDA
                if ($quantidade > $qtdAtual) {
                    throw new \Exception('Estoque insuficiente');
                }
    
                $novaQtd   = $qtdAtual - $quantidade;
                $novoCusto = $custoAtual; // custo não muda
            }
            $this->ajusteEstoque($estoque['id'],$novaQtd,$novoCusto);
            return $novaQtd;
        }

    }

}
