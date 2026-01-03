<?php
namespace Models;

class ClassServico extends ClassCrud{

    #Realizar a inserção no banco de dados
    public function inserServico($arrVar)
    {
        $this->insertDB(
            "servicos",
            "?,?,?,?,?,?,?,?",
            array(
                0,
                $arrVar['nomeServico'],
                $arrVar['categoria'],
                $arrVar['descricao'],
                $arrVar['preco'],
                $arrVar['status'],
                null,
                null
            )
        );

        $b=$this->selectDB(
            "id",
            "servicos",
            "WHERE nome=?",
            array(
                $arrVar['nomeServico'],
            )
        );

        // Pega o ID do último insert
        return $f=$b->fetch(\PDO::FETCH_ASSOC);
    }

        #Realizar a inserção no banco de dados
    public function inserInsumoServico($idServico,$id,$qtd)
    {
        $this->insertDB(
            "servicos_insumos",
            "?,?,?,?",
            array(
                0,
                $idServico,
                $id,
                $qtd
            )
        );
    }

    public function SelectServicos()
    {
        $b=$this->selectDB(
            "*",
            "servicos",
            "",
            array(
                
            )
        );

        return $f=$b->fetchAll(\PDO::FETCH_ASSOC);
    }

}