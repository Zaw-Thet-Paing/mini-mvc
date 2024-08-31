<?php

class QueryBuilder{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;        
    }

    public function select($table, $columns = '*', $where = null)
    {
        $query = "";
        if(isset($where)){
            $query = "SELECT $columns FROM $table WHERE $where";
        }else{
            $query = "SELECT $columns FROM $table";
        }

        $stmt = $this->db->getConnection()->prepare($query);
       
        $stmt->execute();

        return !(isset($where)) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch();
    }

    public function insert($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_map(function($value){
            return ':' . $value;
        }, array_keys($data)));

        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->db->getConnection()->prepare($query);
        foreach($data as $column => $value){
            $stmt->bindValue(':'.$column, $value);
        }
        return $stmt->execute();
    }

    public function update($table, $data, $where)
    {
        $sets = [];
        foreach ($data as $column => $value) {
            $sets[] = "$column = :" . $column;
        }
        $query = "UPDATE $table SET " . implode(', ', $sets) . " WHERE $where";
        $stmt = $this->db->getConnection()->prepare($query);
        foreach ($data as $column => $value) {
            $stmt->bindValue(':' . $column, $value);
        }
        return $stmt->execute();
    }

    public function delete($table, $where)
    {
        $query = "DELETE FROM $table WHERE $where";
        $stmt = $this->db->getConnection()->prepare($query);
        return $stmt->execute();
    }

}