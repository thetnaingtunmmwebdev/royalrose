<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\SaleTable;

$table = new SaleTable(new MySQL());

if($table) {
    $all = $table->getAll();
    echo json_encode($all);
}