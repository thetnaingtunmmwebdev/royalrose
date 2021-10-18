<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\CategoriesTable;
use Helpers\HTTP;

$data = [
    "name" => $_POST['name'] ?? 'Unknown',
    "code" => $_POST['code'] ?? 'Unknown',
];

$table = new CategoriesTable(new MySQL());

if($table) {
    $table->insert($data);
    HTTP::redirect("/categories/createCategory.php", "inserted=true");
} else {
    HTTP::redirect("/categories/index.php", "error=true");
}