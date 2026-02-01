<?php
namespace Models;

class ClassInsumo extends ClassCrud{

    #Realizar a inserção no banco de dados
    public function inserInsuno($arrVar)
    {
        return $b=$this->insertDB(
            "insumos",
            "?,?,?,?,?,?,?",
            array(
                0,
                $arrVar['nome'],
                $arrVar['tamanho'],
                $arrVar['unidade_base'],
                $arrVar['descricao'],
                $arrVar['estoqueMinimo'],
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
                "nome=?, tamanho=?, descricao=?, estoque_minimo=?, unidade_base=?",
                "id=?",
                array(
                    $dados['nome'],
                    $dados['tamanho'],
                    $dados['descricao'],
                    $dados['estoqueMinimo'],
                    $dados['unidade_base'],
                    $dados['id'],
                )
            );
            return true;
        }else{
            return false;
        }
    }

    public function insumoEmUso($id)
    {
        $b=$this->selectDB(
            "*",
            "servicos_insumos",
            "WHERE insumo_id=?",
            array(
                $id,
            )
        );
        $r=$b->rowCount();
        return $r;
    }

        #Realizar a inserção no banco de dados
    public function insertFatorConver($idInsumos,$unidades,$fator)
    {
        return $b=$this->insertDB(
            "insumos_conversao",
            "?,?,?,?",
            array(
                0,
                $idInsumos,
                $unidades,
                $fator
            )
        );
        
    }

}