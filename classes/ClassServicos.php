<?php
namespace Classes;

use Models\ClassServico;


class ClassServicos{
        private $inserServicos;

        public function __construct()
    {
        $this->inserServicos=new ClassServico();
    }

    // INSERIR SERVIÇOS
    public function validateServico($dados){
        
        $id = $this->inserServicos->inserServico($dados);
        return $id['id'];
    }

    // INSERIR INSUMOS
    public function validateInsumos($idServico,$id,$qtd){
        $this->inserServicos->inserInsumoServico($idServico,$id,$qtd);
        $arrResponse=[
            'message' =>"Daodos inseridos com sucesso!",
            'success' => true,
            "erros"=>null
        ];
        // return json_encode($arrResponse);
    }

    //PESQUISAR INSUMOS
    public function getServicos($id=null){
        
        $retorno = $this->inserServicos->SelectServicos($id);
        $arrResponse=[
            'success' => true,
            "data"=>$retorno,
            "erros"=>null
        ];
        return json_encode($arrResponse);
    }
}