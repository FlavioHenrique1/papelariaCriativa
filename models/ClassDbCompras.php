<?php
namespace Models;

use Models\ClassDbEstoque;

class ClassDbCompras extends ClassCrud{

    private $estoque;

        public function __construct()
    {
        parent::__construct();
        $this->estoque=new ClassDbEstoque();

    }
    #Realizar a inserção no banco de dados
    public function inserCompras($arrVar)
    {

        $b=$this->insertDB(
            "compras",
            "?,?,?,?,?",
            array(
                0,
                $arrVar['data'],
                $arrVar['total'],
                $arrVar['status'],
                null
            )
        );
        $i=$this->insertDB(
            "compras_itens",
            "?,?,?,?,?,?,?",
            array(
                0,
                $b,
                $arrVar['insumo'],
                $arrVar['quantidade'],
                $arrVar['valorUnitario'],
                $arrVar['total'],
                null
            )
        );
        return $b;
    }

    #Veriricar se já existe o mesmo email cadastro no db
    public function getComprasItens($id = null)
    {
        if ($id) {
            // Busca apenas uma compra (por ID)
            $b = $this->selectDB(
                "
                c.id            AS compra_id,
                c.data_compra   AS data,
                c.valor_total   AS total,
                c.status   AS status,
                ci.id           AS item_id,
                ci.quantidade,
                ci.valor_unitario,
                i.id            AS insumo_id,
                i.nome          AS insumo
                ",
                "compras c
                INNER JOIN compras_itens ci ON ci.compra_id = c.id
                INNER JOIN insumos i ON i.id = ci.insumo_id",
                "WHERE c.id = ?",
                [$id]
            );
        } else {
            // Busca TODAS as compras
            $b = $this->selectDB(
                "
                c.id            AS compra_id,
                c.data_compra   AS data,
                c.valor_total   AS total,
                c.status   AS status,
                ci.id           AS item_id,
                ci.quantidade,
                ci.valor_unitario,
                i.nome          AS insumo
                ",
                "compras c
                INNER JOIN compras_itens ci ON ci.compra_id = c.id
                INNER JOIN insumos i ON i.id = ci.insumo_id",
                "",
                []
            );
        }

        return $b->fetchAll(\PDO::FETCH_ASSOC);
    }


    #Deleta insumos
    public function deleteCompras($id)
    {
        $this->deleteDB(
            "compras_itens",
            "compra_id=?",
            array(
                $id
            )
        );
        $this->deleteDB(
            "compras",
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

}