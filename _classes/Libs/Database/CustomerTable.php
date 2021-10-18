<?php

namespace Libs\Database;

use PDOException;

class CustomerTable
{
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function getAll()
    {
        $statement = $this->db->query("SELECT * FROM customers ORDER BY id");

        return $statement->fetchAll();
    }

    public function insert($name)
    {
        try {
            $statement = $this->db->prepare("INSERT INTO customers(name) VALUES (:name)");

            $statement->execute([':name'=> $name]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function suspend($id)
    {
        $statement = $this->db->prepare("
            UPDATE customers SET status = 0 WHERE id = :id
        ");

        $statement->execute([':id'=> $id]);

        return $statement->rowCount();
    }

    public function unsuspend($id)
    {
        $statement = $this->db->prepare("
            UPDATE customers SET status = 1 WHERE id = :id
        ");

        $statement->execute([':id'=> $id]);

        return $statement->rowCount();
    }

    public function delete($id)
    {
        $statement = $this->db->prepare("
            DELETE FROM customers WHERE id = :id
        ");

        $statement->execute([':id'=>$id]);

        return $statement->rowCount();
    }
}