<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\SubCategoriesTable;
use Helpers\HTTP;

$data = [
    "name" => $_POST['name'] ?? 'Unknown',
    "code" => $_POST['code'] ?? 'Unknown',
    "category_id" => $_POST['category_id'] ?? 'Unknown',
];

$table = new SubCategoriesTable(new MySQL());

if($table) {
    $table->insert($data);
    HTTP::redirect("/sub_categories/createSubCategory.php", "inserted=true");
} else {
    HTTP::redirect("/sub_categories/index.php", "error=true");
}