<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\ItemsTable;

$table = new ItemsTable(new MySQL());
$all = $table->getAll();

$dataset = array(
    "echo" => 1,
    "totalrecords" => count($all),
    "totaldisplayrecords" => count($all),
    "data" => $all
);

echo json_encode($dataset);