<?php

namespace Models;

class ClassDbHistorico extends ClassCrud {

    public function getByInsumo($insumoId)
    {
        if($insumoId==null){
            $b = $this->selectDB(
                "*",
                "estoque",
                "",
                []
            );
        }else{
            $b = $this->selectDB(
                "*",
                "estoque",
                "WHERE insumo_id = ?",
                [$insumoId]
            );
        }

        return $b->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($dados)
    {
        
        return $this->insertDB(
            "estoque",
            "?,?,?,?,?,?,?,?,?",
            [
                0,
                $dados['insumo_id'],
                $dados['tipo'],
                $dados['quantidade'],
                $dados['custo_medio'],
                $dados['origem'],
                $dados['origemId'],
                $dados['saldo_resultante'],
                date('Y-m-d H:i:s')
            ]
        );
    }

    public function update($id, $quantidade, $custo)
    {
        return $this->updateDB(
            "estoque",
            "quantidade=?, custo_medio=?",
            "id=?",
            [$quantidade, $custo, $id]
        );
    }
}
