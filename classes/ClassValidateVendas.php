<?php
namespace Classes;

use Models\ClassDbVendas;

class ClassValidateVendas{
        private $dbVendas;
        

    public function __construct()
    {
        $this->dbVendas=new ClassDbVendas();
    }


    // INSERIR INSUMOS
    public function inserirVendasDb($userId,$dados){
        

        $idVendas=$this->dbVendas->inserVendas($userId,$dados);
        $arrResponse=[
            'message' =>"Daodos inseridos com sucesso!",
            'success' => true,
            'idvendas'=>$idVendas,
            "erros"=>null
        ];
        return $arrResponse;
    }

    // // INSERIR INSUMOS
    public function inserirItensVendasDb($dados){
        
        $retorno=$this->dbVendas->inserItensVendas($dados);
        $arrResponse=[
            'message' =>"Daodos inseridos com sucesso!",
            'success' => true,
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

    // // INSERIR COMPRAS
    // public function listarCompras($id=null){
        
    //     $arrResponse=[
    //         'message' =>"Daodos inseridos com sucesso!",
    //         'success' => true,
    //         "erros"=>null
    //     ];
    //     $dados=$this->dbCompras->getComprasItens($id);
    //     return json_encode($dados);
    // }

    //     // APAGAR COMPRAS
    // public function apagarCompras($id=null){
        
    //     $arrResponse=[
    //         'message' =>"Daodos inseridos com sucesso!",
    //         'success' => true,
    //         "erros"=>null
    //     ];
    //     $this->dbCompras->deleteCompras($id);
    //     return json_encode($arrResponse);
    // }

}