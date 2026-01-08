<?php
namespace Classes;

use Models\ClassServico;


class ClassServicos{
        private $inserServicos;
        private $erro;


        public function __construct()
    {
        $this->inserServicos=new ClassServico();
    }
        public function getErro()
    {
        return $this->erro;
    }

    public function setErro($erro)
    {
        array_push($this->erro,$erro);
    }

    // INSERIR SERVIÇOS
    public function validateServico($dados)
    {
        $retorno = $this->inserServicos->SelecCampoServico("nome", $dados['nomeServico']);

        if ($retorno["rows"] > 0) {
            return [
                'success' => false,
                'erros'   => true,
                'message' => "Já existe um serviço com esse nome!"
            ];
        }

        $id = $this->inserServicos->inserServico($dados);

        if (!$id) {
            return [
                'success' => false,
                'erros'   => true,
                'message' => "Erro ao inserir serviço"
            ];
        }

        return [
            'success' => true,
            'erros'   => false,
            'data'    => $id
        ];
    }

    public function getInsumos($idServico){
        return $this->inserServicos->getInsumosByServico($idServico);
    }


    // INSERIR INSUMOS
    public function validateInsumos($idServico,$id,$qtd){
        $this->inserServicos->inserInsumoServico($idServico,$id,$qtd);
        $arrResponse=[
            'message' =>"Daodos inseridos com sucesso!",
            'success' => true,
            "erros"=>null
        ];
        return json_encode($arrResponse);
    }

    //PESQUISAR SERVIÇOS
    public function getServicos($id=null){
        $r=null;
        if($id == null){
            $retorno = $this->inserServicos->SelectServicos();
        }else{
            $retorno = $this->inserServicos->SelecCampoServico("id",$id);
            $r=$this->getInsumos($id);
        }
        
        $arrResponse=[
            'success' => true,
            "data"=>$retorno,
            "insumos"=>$r,
            "erros"=>null
        ];
        return json_encode($arrResponse);
    }

    //PESQUISAR SERVIÇOS
    public function apagarServicos($id){
        $this->inserServicos->deleteServicos($id);
        $arrResponse=[
            'success' => true,
            "erros"=>null
        ];
        return json_encode($arrResponse);
    }

    //APAGAR INSUMOS DO SERVIÇO
    public function apagarInsumosServ($idServico){
        $this->inserServicos->deleteInsumosServ($idServico);
        $arrResponse=[
            'success' => true,
            "erros"=>null
        ];
        return json_encode($arrResponse);
    }

    //EDITAR SERVIÇOS
    public function editarServ($idServico,$dados){
        $this->inserServicos->editServico($idServico,$dados);
        return [
        'success' => true,
        'erros'   => false,
        'data'    => $idServico
        ];

    }


}