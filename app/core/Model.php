<?php

class Model
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->db = new QueryBuilder(Database::getInstance());
    }

    public function all()
    {
        return $this->db->select($this->table);
    }

    public function find($id)
    {
        return $this->db->select($this->table, '*', "id = $id");
    }

    public function create($data)
    {
        
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->update($this->table, $data, "id = $id");
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, "id = $id");
    }

}