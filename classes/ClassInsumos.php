<?php
namespace Classes;

use Models\ClassInsumo;


class ClassInsumos{
        private $inserirIns;
        private $erro=[];
        

        public function __construct()
    {
        $this->inserirIns=new ClassInsumo();
    }

    // INSERIR INSUMOS
    public function inserirInsumos($dados,$unidades,$fatores){
        if(count($this->getErro())>0){
            $arrResponse=[
                "retorno"=>"erro",
                'success' => false,
                "message"=>$this->getErro()
            ];
        }else{
            $idInsumos=$this->inserirIns->inserInsuno($dados);
            $this->validarinsumos_conversao($idInsumos,$unidades,$fatores);
            $arrResponse=[
                "retorno"=>"erro",
                'success' => true,
                "message"=>'Dados inseridos com sucesso!'
            ];
        }
        

        return json_encode($arrResponse);
    }
    
    // INSERIR INSUMOS
    public function validarinsumos_conversao($idInsumos,$unidades,$fatores){
        // getConversao
        
        if($this->inserirIns->getConversao($idInsumos)>1){
            $this->inserirIns->deleteConversao($idInsumos);
        }
        foreach ($unidades as $i => $unidade) {
            $fator = $fatores[$i] ?? null;
            $this->inserirIns->insertFatorConver($idInsumos,$unidade,$fator);
        }
    }

    public function validarNome($nomeInsumos,$tamanho){
        $retorno = $this->inserirIns->getInsumos();

        $nomeInsumos = trim(strtolower($nomeInsumos));

        foreach ($retorno as $insumo) {
            if (strtolower(trim($insumo['nome'])) === strtolower(trim($nomeInsumos))
                    &&
                strtolower(trim($insumo['tamanho'])) === strtolower(trim($tamanho))) {
                return $this->setErro("Ja existe um insumo com esse nome e tamanho!");
            }
        }
        return [
            'erro' => false
        ];

    }

    /**
     * Valida campos obrigatórios do POST
     *
     * @param array $dados        Array ($_POST ou outro)
     * @param array $obrigatorios ['nome' => 'Nome', 'descricao' => 'Descrição']
     */
    public function validarCampos(array $dados, array $obrigatorios)
    {
        foreach ($obrigatorios as $campo => $label) {

            if (
                !isset($dados[$campo]) ||
                trim($dados[$campo]) === ''
            ) {
                
                $this->setErro("O campo {$label} é obrigatório!");
                // return [
                //     'success' => false,
                //     'message' => "O campo {$label} é obrigatório"
                // ];
            }
        }

        return ['success' => true];
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
    public function atualizarInsumo($dados,$unidades,$fatores){
    
        $retorno = $this->inserirIns->atualizarInsumos($dados);
        $this->validarinsumos_conversao($dados['id'],$unidades,$fatores);
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


    public function getErro()
    {
        return $this->erro;
    }

    public function setErro($erro)
    {
        array_push($this->erro,$erro);
    }

    public function getConversaoIns($idInsumo){
       $retorno = $this->inserirIns-> getConversao($idInsumo);
        $arrResponse=[
            'success' => true,
            "data"=>$retorno,
            "erros"=>null
        ];
        return json_encode($arrResponse);
    }
}