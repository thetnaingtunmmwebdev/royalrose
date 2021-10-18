<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\StockOpeningTable;
use Helpers\HTTP;

$data = [
    "item_id" => $_POST['item_id'] ?? 'Unknown',
    "qty" => $_POST['qty'] ?? 'Unknown',
    "type" => $_POST['type'] ?? 'SO',
    "price" => $_POST['price'] ?? '0',
];

$table = new StockOpeningTable(new MySQL());

if($table) {
    $table->insert($data);
    HTTP::redirect("../stockOpening/createStockOpening.php", "inserted=true");
} else {
    HTTP::redirect("../stockOpening/index.php", "error=true");
}