<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\SaleTable;

$id = $_POST['item_id'];
$pType = $_POST['pType'];

$table = new SaleTable(new MySQL());

if($table) {
    $all = $table->getOne($id, $pType);
    echo json_encode($all);
}