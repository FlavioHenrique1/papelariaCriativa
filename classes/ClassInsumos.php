<?php
namespace Classes;

use Models\ClassInsumo;


class ClassInsumos{
        private $inserirIns;

        public function __construct()
    {
        $this->inserirIns=new ClassInsumo();
    }

    public function inserirInsumos($dados){
        
        $arrResponse=[
            "retorno"=>"success",
            "erros"=>null
        ];
        $this->inserirIns->inserInsuno($dados);
        return json_encode($arrResponse);
    }

}