<?php
namespace Models;

abstract class ClassCrud extends ClassConexao {

    protected $crud;
    protected $db; // 👈 guarda o PDO aqui

    public function __construct()
    {
        $this->db = $this->conectaDB(); // 🔥 pega a conexão
    }

    protected function prepareExecute($sql, $exec)
    {
        $this->crud = $this->db->prepare($sql);
        $this->crud->execute($exec);
    }

    public function selectDB($fields, $table, $where, $exec)
    {
        $this->prepareExecute(
            "SELECT {$fields} FROM {$table} {$where}",
            $exec
        );
        return $this->crud;
    }

    public function insertDB($table, $values, $exec)
    {
        $this->prepareExecute(
            "INSERT INTO {$table} VALUES ({$values})",
            $exec
        );

        return $this->db->lastInsertId(); // 🔥 FUNCIONA
    }

    public function updateDB($table, $set, $where, $exec)
    {
        $this->prepareExecute(
            "UPDATE {$table} SET {$set} WHERE {$where}",
            $exec
        );
    }

    public function deleteDB($table, $where, $exec)
    {
        $this->prepareExecute(
            "DELETE FROM {$table} WHERE {$where}",
            $exec
        );
    }
}
