<?php

namespace Models;

class ClassDbEstoque extends ClassCrud
{
    #estoque atual

    #retorna o estoque atual
    public function getByInsumo($insumoId = null)
    {

        if ($insumoId == null) {
            $b = $this->selectDB(
                "
                    ea.insumo_id,
                    ea.quantidade,
                    ea.custo_medio,
                    ea.atualizado_em,
                    i.nome,
                    i.tamanho,
                    i.estoque_minimo
                ",
                "estoque_atual ea
                INNER JOIN insumos i ON i.id = ea.insumo_id",
                "",
                []
            );
        } else {
            $b = $this->selectDB(
                "
                    ea.insumo_id,
                    ea.quantidade,
                    ea.custo_medio,
                    ea.atualizado_em,
                    i.nome,
                    i.tamanho
                ",
                "estoque_atual ea
                INNER JOIN insumos i ON i.id = ea.insumo_id",
                "WHERE ea.insumo_id=?",
                [$insumoId]
            );
        }
        return $b->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($dados)
    {

        return $this->insertDB(
            "estoque_atual",
            "?,?,?,?,?",
            [
                0,
                $dados['insumo_id'],
                $dados['quantidade'],
                $dados['custo_medio'],
                date('Y-m-d H:i:s')
            ]
        );
    }

    public function update($id, $quantidade, $custo)
    {
        return $this->updateDB(
            "estoque_atual",
            "quantidade=?, custo_medio=?",
            "id=?",
            [$quantidade, $custo, $id]
        );
    }
}
