<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\CustomerTable;
use Helpers\HTTP;

$name = $_POST['name'] ?? 'Unknown';

$table = new CustomerTable(new MySQL());

if($table) {
    $table->insert($name);
    HTTP::redirect("/customers/createCustomer.php", "inserted=true");
} else {
    HTTP::redirect("/customers/index.php", "error=true");
}