<?php
namespace Classes;

use Models\ClassInsumo;


class ClassInsumos{
        private $inserirIns;

        public function __construct()
    {
        $this->inserirIns=new ClassInsumo();
    }

    // INSERIR INSUMOS
    public function inserirInsumos($dados){
        
        $arrResponse=[
            'message' =>"Daodos inseridos com sucesso!",
            'success' => true,
            "erros"=>null
        ];
        $this->inserirIns->inserInsuno($dados);
        return json_encode($arrResponse);
    }

    // VALIDAR CAMPOS
    public function ValidarCapos($campo){
        if (empty($campo)) {
            echo json_encode([
                'success' => false,
                'message' => 'Nome é obrigatório'
            ]);
            exit;
        }
    }

    //PESQUISAR INSUMOS
    public function selectInsumos($id=null){
        
        $retorno = $this->inserirIns->getInsumos($id);
        $arrResponse=[
            'success' => true,
            "data"=>$retorno,
            "erros"=>null
        ];
        return json_encode($arrResponse);
    }

    // EXCLUIR INSUMOS
    public function excluirInsumo($id=null){
        $r=$this->inserirIns->insumoEmUso($id);
        if ($this->inserirIns->insumoEmUso($id) > 0) {
            $arrResponse=[
                'success' => false,
                'message' => 'Este insumo está vinculado a um serviço e não pode ser excluído.'
            ];
        }else{
            $this->inserirIns->deleteInsumos($id);
            $arrResponse=[
                'success' => true,
                'message' => 'Insumo excluído com sucesso.'
            ];
        };
        
        return json_encode($arrResponse);
    }

    // EDITAR INSUMOS
    public function atualizarInsumo($dados){
    
        $retorno = $this->inserirIns->atualizarInsumos($dados);
        if($retorno=true){
            $arrResponse=[
                'message'=> "Dados atualizado com sucesso!",
                'success' => true,
                "data"=>$retorno,
                "erros"=>null
            ];
        }else{
            $arrResponse=[
                'message'=> "Erro ao atualizar.",
                "retorno"=>"erro",
                "erros"=>true
            ];
        }
        

        return json_encode($arrResponse);
    }

}