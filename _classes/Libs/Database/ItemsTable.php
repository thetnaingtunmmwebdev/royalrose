<?php

namespace Libs\Database;

use PDOException;

class ItemsTable
{
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function getAll()
    {
        $statement = $this->db->query("SELECT items.*, categories.name as category_name, sub_categories.name as sub_category_name 
            FROM items 
                INNER JOIN categories ON items.category_id = categories.id
                INNER JOIN sub_categories ON items.sub_category_id = sub_categories.id
             ORDER BY items.id DESC");

        return $statement->fetchAll();
    }

    public function getModel()
    {
        $statement = $this->db->query("SELECT * FROM items GROUP BY items.model ORDER BY items.brand ASC");

        return $statement->fetchAll();
    }

    public function insert($data)
    {
        try {
            $query = "INSERT INTO items(brand,model,category_id,sub_category_id) VALUES (:brand, :model, :category_id, :sub_category_id)";
            $statement = $this->db->prepare($query);
            $statement->execute($data);

            return $this->db->lastInsertId(); 
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function suspend($id)
    {
        $statement = $this->db->prepare("
            UPDATE items SET status = 0 WHERE id = :id
        ");

        $statement->execute([':id'=> $id]);

        return $statement->rowCount();
    }

    public function unsuspend($id)
    {
        $statement = $this->db->prepare("
            UPDATE items SET status = 1 WHERE id = :id
        ");

        $statement->execute([':id'=> $id]);

        return $statement->rowCount();
    }

    public function delete($id)
    {
        $statement = $this->db->prepare("
            DELETE FROM items WHERE id = :id
        ");

        $statement->execute([':id'=>$id]);

        return $statement->rowCount();
    }
}