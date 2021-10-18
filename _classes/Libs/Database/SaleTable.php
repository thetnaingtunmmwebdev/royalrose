<?php

namespace Libs\Database;

use PDOException;

class SaleTable
{
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function getOne($id, $pType)
    {
        $statement = $this->db->prepare("
        SELECT price.$pType as price, items.id as item_id, items.brand as Brand, items.model as Model, categories.name as Cname, sub_categories.name as Subname FROM price
        LEFT JOIN items ON items.id = price.item_id
        LEFT JOIN categories ON categories.id = items.category_id
        LEFT JOIN sub_categories ON sub_categories.id = items.sub_category_id
        WHERE price.item_id = :id;
        ");

        $statement->execute([':id'=> $id]);

        return $statement->fetchAll();

        
    }

    public function getAll() {
        $statement = $this->db->query("
            SELECT stock.date, stock.invoice, SUM(stock.total - stock.discount) - stock.inv_discount AS Gtotal, customers.name as customer FROM stock 
            LEFT JOIN customers ON customers.id = stock.customer_id
            WHERE stock.type = 'SA'
            GROUP BY stock.invoice ORDER BY stock.invoice DESC
        ");

        return $statement->fetchAll();
    }

    public function getInvoice() {
        $statement = $this->db->query("
            SELECT stock.invoice FROM stock ORDER BY id DESC LIMIT 1;
        ");

        return $statement->fetchAll();
    }

    public function insert($data)
    {
        try {
            $query = "INSERT INTO stock(item_id,qty,price,discount,total,type,inv_discount,invoice,customer_id,date) 
                VALUES (:item_id, :qty, :price, :discount, :total, :type, :inv_discount, :invoice, :customer_id, :date)";
            $statement = $this->db->prepare($query);
            $statement->execute($data);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}