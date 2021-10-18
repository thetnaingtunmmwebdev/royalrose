<?php

namespace Libs\Database;

use PDOException;

class PriceTable
{
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function getAll()
    {
        $statement = $this->db->query("SELECT price.*, items.brand AS brand, items.model AS model, sub_categories.name AS SubName FROM price
        INNER JOIN items ON price.item_id = items.id
        INNER JOIN sub_categories ON items.sub_category_id = sub_categories.id;");

        return $statement->fetchAll();
    }

    public function insert($data)
    {
        try {
            $query = "INSERT INTO price(item_id,retail_one,retail_two,whole_one,whole_two,whole_three,whole_four,whole_five,purchase) 
                VALUES (:item_id, :retail_one, :retail_two, :whole_one, :whole_two, :whole_three, :whole_four, :whole_five, :purchase)";
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
            UPDATE price SET status = 0 WHERE id = :id
        ");

        $statement->execute([':id'=> $id]);

        return $statement->rowCount();
    }

    public function unsuspend($id)
    {
        $statement = $this->db->prepare("
            UPDATE price SET status = 1 WHERE id = :id
        ");

        $statement->execute([':id'=> $id]);

        return $statement->rowCount();
    }

    public function delete($id)
    {
        $statement = $this->db->prepare("
            DELETE FROM price WHERE id = :id
        ");

        $statement->execute([':id'=>$id]);

        return $statement->rowCount();
    }
}