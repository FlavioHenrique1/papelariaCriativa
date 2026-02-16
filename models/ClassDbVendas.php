<?php
namespace Models;

use Models\ClassDbEstoque;

class ClassDbVendas extends ClassCrud{

    private $estoque;

        public function __construct()
    {
        parent::__construct();
        $this->estoque=new ClassDbEstoque();

    }
    #Realizar a inserção no banco de dados
    public function inserVendas($usuarioId,$arrVar)
    {

        $b=$this->insertDB(
            "vendas",
            "?,?,?,?,?,?,?,?,?,?",
            array(
                0,
                $usuarioId,
                $arrVar['cliente_nome'],
                $arrVar['cliente_contato'],
                $arrVar['valorTotal'],
                $arrVar['desconto'],
                $arrVar['valor_pago'],
                $arrVar['forma_pagamento'],
                $arrVar['status'],
                null
            )
        );
        return $b;
    }

    #Realizar a inserção no banco de dados dos itens da venda
    public function inserItensVendas($arrVar)
    {

        $b=$this->insertDB(
            "vendas_itens",
            "?,?,?,?,?,?,?",
            array(
                0,
                $arrVar['idVendas'],
                $arrVar['servico_id'],
                $arrVar['qtd'],
                $arrVar['custoUnit'],
                $arrVar['total'],
                null
            )
        );
        return $b;
    }

}