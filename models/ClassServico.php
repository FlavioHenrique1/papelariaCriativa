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
        $retorno = $this->SelecCampoServico("nome", $arrVar['nomeServico']);

        return $retorno['data']['id'] ?? null;
    }

    #Selecionar 

    public function SelecCampoServico($campo,$valor){
        $b=$this->selectDB(
            "*",
            "servicos",
            "WHERE ".$campo."=?",
            array(
                $valor,
            )
        );

        // Pega o ID do último insert
        $f=$b->fetch(\PDO::FETCH_ASSOC);
        $r=$b->rowCount();
        return $arrData=[
            "data"=>$f,
            "rows"=>$r
        ];
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

    #Deleta Serviços
    public function deleteServicos($id)
    {
        $this->deleteDB(
            "servicos",
            "id=?",
            array(
                $id
            )
        );
    }

    #Buscar os insumos da função
    public function getInsumosByServico($servicoId)
    {
        return $this->selectDB(
            "i.id, i.nome,si.quantidade",
            "servicos_insumos si 
            INNER JOIN insumos i ON i.id = si.insumo_id",
            "WHERE si.servico_id = ?",
            [$servicoId]
        )->fetchAll(\PDO::FETCH_ASSOC);
    }

    #Deleta insumos do serviço
    public function deleteInsumosServ($idServico)
    {
        $this->deleteDB(
            "servicos_insumos",
            "servico_id=?",
            array(
                $idServico
            )
        );
    }

    #Editar serviços
    public function editServico($idServico,$arrVar)
    {
        $this->updateDB(
                "servicos",
                "nome=?, categoria=?, descricao=?, preco=? , status=?",
                "id=?",
                array(
                $arrVar['nomeServico'],
                $arrVar['categoria'],
                $arrVar['descricao'],
                $arrVar['preco'],
                $arrVar['status'],
                $idServico
                )
            );
            return true;
    }

}