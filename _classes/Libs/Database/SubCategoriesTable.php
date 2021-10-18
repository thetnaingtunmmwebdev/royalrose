<?php

namespace Libs\Database;

use PDOException;

class SubCategoriesTable
{
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function getAll()
    {
        $statement = $this->db->query("SELECT sub_categories.*, categories.name as categoryName FROM `sub_categories` LEFT JOIN categories ON sub_categories.category_id = categories.id ORDER BY sub_categories.id DESC");

        return $statement->fetchAll();
    }

    public function insert($data)
    {
        try {
            $query = "INSERT INTO sub_categories(name,code, category_id) VALUES (:name, :code, :category_id)";
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
            UPDATE sub_categories SET status = 0 WHERE id = :id
        ");

        $statement->execute([':id'=> $id]);

        return $statement->rowCount();
    }

    public function unsuspend($id)
    {
        $statement = $this->db->prepare("
            UPDATE sub_categories SET status = 1 WHERE id = :id
        ");

        $statement->execute([':id'=> $id]);

        return $statement->rowCount();
    }

    public function delete($id)
    {
        $statement = $this->db->prepare("
            DELETE FROM sub_categories WHERE id = :id
        ");

        $statement->execute([':id'=>$id]);

        return $statement->rowCount();
    }
}