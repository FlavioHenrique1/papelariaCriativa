<?php
namespace Models;

class ClassInsumo extends ClassCrud{

    #Realizar a inserção no banco de dados
    public function inserInsuno($arrVar)
    {
        $this->insertDB(
            "insumos",
            "?,?,?,?,?,?",
            array(
                0,
                $arrVar['nome'],
                $arrVar['estoque'],
                0,
                $arrVar['descricao'],
                null
            )
        );
    }
}