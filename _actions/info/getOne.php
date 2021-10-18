<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\InfoTable;

$brand = $_POST['brand'];
$model = $_POST['model'];

$table = new InfoTable(new MySQL());

if($table) {
    $all = $table->getOne($brand, $model);
    echo json_encode($all);
}