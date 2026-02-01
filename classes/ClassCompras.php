<?php
namespace Classes;

use Models\ClassDbCompras;


class ClassCompras{
        private $dbCompras;

    public function __construct()
    {
        $this->dbCompras=new ClassDbCompras();
    }

    // INSERIR INSUMOS
    public function inserirComprasDb($dados){
        
        $idCompra=$this->dbCompras->inserCompras($dados);
        $arrResponse=[
            'message' =>"Daodos inseridos com sucesso!",
            'success' => true,
            'idCompra'=>$idCompra,
            "erros"=>null
        ];
        return $arrResponse;
    }

    function normalizarValor($valor){
        // Remove tudo que não for número, vírgula ou ponto
        $valor = preg_replace('/[^\d,\.]/', '', $valor);

        // Se vier no padrão brasileiro: 1.234,56
        if (strpos($valor, ',') !== false) {
            $valor = str_replace('.', '', $valor); // remove milhar
            $valor = str_replace(',', '.', $valor); // vírgula vira ponto
        }

    return (float) $valor;
}

    // INSERIR COMPRAS
    public function listarCompras($id=null){
        
        $arrResponse=[
            'message' =>"Daodos inseridos com sucesso!",
            'success' => true,
            "erros"=>null
        ];
        $dados=$this->dbCompras->getComprasItens($id);
        return json_encode($dados);
    }

        // APAGAR COMPRAS
    public function apagarCompras($id=null){
        
        $arrResponse=[
            'message' =>"Daodos inseridos com sucesso!",
            'success' => true,
            "erros"=>null
        ];
        $this->dbCompras->deleteCompras($id);
        return json_encode($arrResponse);
    }

}