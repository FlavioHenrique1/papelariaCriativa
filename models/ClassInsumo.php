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

    #Veriricar se já existe o mesmo email cadastro no db
    public function getInsumos($id)
    {
        if($id){
            $b=$this->selectDB(
                "*",
                "insumos",
                "where email=?",
                array(
                    $id
                )
            );
        }else{
            $b=$this->selectDB(
                "*",
                "insumos",
                "",
                array(
                    
                )
            );
        }

        return $f=$b->fetchAll(\PDO::FETCH_ASSOC);
    }

    #Deleta insumos
    public function deleteInsumos($id)
    {
        $this->deleteDB(
            "insumos",
            "id=?",
            array(
                $id
            )
        );
    }

        #Verificar a confirmação de cadastro pelo email
    public function atualizarInsumos($dados)
    {
        $b=$this->selectDB(
            "*",
            "insumos",
            "WHERE id=?",
            array(
                $dados['id'],
            )
        );
        $r=$b->rowCount();
        if($r >0){
            $this->updateDB(
                "insumos",
                "nome=?, estoque=?, descricao=?",
                "id=?",
                array(
                    $dados['nome'],
                    $dados['estoque'],
                    $dados['descricao'],
                    $dados['id'],
                )
            );
            return true;
        }else{
            return false;
        }
    }

}