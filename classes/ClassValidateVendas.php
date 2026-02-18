<?php
namespace Classes;

use Models\ClassDbVendas;
use Classes\ClassServicos;
use Classes\ClassHistorico;


class ClassValidateVendas{
        private $dbVendas;
        private $serviços;
        private $historico;
        

    public function __construct()
    {
        $this->dbVendas=new ClassDbVendas();
        $this->serviços=new ClassServicos();
        $this->historico=new ClassHistorico();

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
        $dadosServicos=$this->extrairServicos($dados['servico_id'],$dados['idVendas'],$dados['qtd']);
        if($dadosServicos['success']){
            $retorno=$this->dbVendas->inserItensVendas($dados);
            $arrResponse=[
                'message' =>"Daodos inseridos com sucesso!",
                'success' => true,
                "erros"=>null
            ];
            return $arrResponse;
        }else{
            $arrResponse=[
                'message' =>$dadosServicos['message'],
                'success' => false,
            ];
            return $arrResponse;
        }
    }

    public function extrairServicos($id,$idservico=0,$qtd){
       $insumosServicos=$this->serviços->getInsumos($id);
       
        foreach($insumosServicos as $insumo){
            $insumoId = $insumo['id'];
            $quantidade = $insumo['quantidade'];

            $qtdTotal=$quantidade*$qtd;
            $retorn=$this->historico->movimentar($insumoId,$qtdTotal,0,"saida","vendas",$idservico);
        }

        return $retorn;

    }
}