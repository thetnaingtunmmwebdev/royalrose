<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\PriceTable;
use Helpers\HTTP;

$data = [
    "item_id" => $_POST['item_id'] ?? 'Unknown',
    "retail_one" => $_POST['retail1'] ?? '0',
    "retail_two" => $_POST['retail2'] ?? '0',
    "whole_one" => $_POST['w1'] ?? '0',
    "whole_two" => $_POST['w2'] ?? '0',
    "whole_three" => $_POST['w3'] ?? '0',
    "whole_four" => $_POST['w4'] ?? '0',
    "whole_five" => $_POST['w5'] ?? '0',
    "purchase" => $_POST['purchase'] ?? '0',
    
];

$table = new PriceTable(new MySQL());

if($table) {
    $table->insert($data);
    HTTP::redirect("/price/createPrice.php", "inserted=true");
} else {
    HTTP::redirect("/price/index.php", "error=true");
}