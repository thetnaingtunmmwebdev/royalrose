<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\ItemsTable;
use Helpers\HTTP;

$data = [
    "brand" => $_POST['brand'] ?? 'Unknown',
    "model" => $_POST['model'] ?? 'Unknown',
    "category_id" => $_POST['category_id'] ?? 'Unknown',
    "sub_category_id" => $_POST['sub_category_id'] ?? 'Unknown',
];

$table = new ItemsTable(new MySQL());

if($table) {
    $table->insert($data);
    HTTP::redirect("/items/createItem.php", "inserted=true");
} else {
    HTTP::redirect("/items/items.php", "error=true");
}