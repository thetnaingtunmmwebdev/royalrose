<?php

namespace Libs\Database;

use PDOException;

class InfoTable
{
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function getOne($brand, $model)
    {
        $statement = $this->db->prepare("
        SELECT t1.brand, t1.model, t1.Cname, t1.Subname, (t1.Qty - ifnull(t2.Qty,0)) as Qty, t1.R1, t1.W1, t1.W2, t1.W3, t1.W4, t1.W5 
        FROM (SELECT items.brand as brand, items.model as model, categories.name as Cname, sub_categories.name as Subname, 
            stock.item_id as itemid, SUM(stock.qty) as Qty, price.retail_one as R1, price.whole_one as W1, 
                price.whole_two as W2, price.whole_three as W3, price.whole_four as W4, price.whole_five as W5 
            FROM stock
            LEFT JOIN price ON price.item_id = stock.item_id
            LEFT JOIN items ON items.id = stock.item_id
            LEFT JOIN categories ON categories.id = items.category_id
            LEFT JOIN sub_categories ON sub_categories.id = items.sub_category_id
            WHERE stock.item_id IN 
            (SELECT items.id FROM items WHERE items.model = :model AND items.brand = :brand) AND stock.type <> 'SA'
            GROUP BY stock.item_id) t1
        LEFT JOIN
            (SELECT items.brand as brand, items.model as model, categories.name as Cname, sub_categories.name as Subname, 
            stock.item_id as itemid, SUM(stock.qty) as Qty, price.retail_one as R1, price.whole_one as W1, 
            price.whole_two as W2, price.whole_three as W3, price.whole_four as W4, price.whole_five as W5 
            FROM stock
            LEFT JOIN price ON price.item_id = stock.item_id
            LEFT JOIN items ON items.id = stock.item_id
            LEFT JOIN categories ON categories.id = items.category_id
            LEFT JOIN sub_categories ON sub_categories.id = items.sub_category_id
            WHERE stock.item_id IN 
            (SELECT items.id FROM items WHERE items.model = :model AND items.brand = :brand) AND stock.type = 'SA'
            GROUP BY stock.item_id) t2
        ON t1.itemid = t2.itemid
        ");

        $statement->execute([':brand'=> $brand, ':model'=> $model]);

        return $statement->fetchAll();

        
    }
}