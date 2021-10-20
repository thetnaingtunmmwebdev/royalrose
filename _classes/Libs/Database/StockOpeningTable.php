<?php

namespace Libs\Database;

use PDOException;

class StockOpeningTable
{
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function getAll()
    {
        $statement = $this->db->query("SELECT stock.*, items.brand AS brand, items.model AS model, sub_categories.name AS SubName FROM stock
        INNER JOIN items ON stock.item_id = items.id
        INNER JOIN sub_categories ON items.sub_category_id = sub_categories.id
        WHERE stock.type = 'SO';");

        return $statement->fetchAll();
    }

    public function insert($data)
    {
        try {
            $query = "INSERT INTO stock(item_id,qty,type,price) VALUES (:item_id, :qty, :type, :price)";
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