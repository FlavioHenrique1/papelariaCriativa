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
        
        if (!$estoque ) {
            // ✅ Se for ENTRADA → cria registro
            if ($tipo === 'entrada') {

                $saldo_resultante = $quantidade;

                $this->dbEstoque->insert([
                    'insumo_id'   => $insumoId,
                    'quantidade'  => $quantidade,
                    'custo_medio' => $valorUnitario,
                ]);
                $arrResponse=[
                    'message' =>"Daodos inseridos com sucesso!",
                    'success' => true,
                    'dados' => $saldo_resultante,
                ];
                return $arrResponse;
            }

            // ❌ Se for SAÍDA → não pode criar
            if ($tipo === 'saida') {
                $arrResponse=[
                    'message' =>"Item não existe no estoque",
                    'success' => false,
                ];
                return $arrResponse;
            }
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
                $arrResponse=[
                    'message' =>"Estoque insuficiente!",
                    'success' => false,
                ];
                    return $arrResponse;
                }
    
                $novaQtd   = $qtdAtual - $quantidade;
                $novoCusto = $custoAtual; // custo não muda
            }
            $this->ajusteEstoque($estoque['id'],$novaQtd,$novoCusto);
            $arrResponse=[
                'message' =>"Daodos inseridos com sucesso!",
                'success' => true,
                'dados' => $novaQtd,
            ];
            return $arrResponse;
        }

    }

}
