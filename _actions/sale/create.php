<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\SaleTable;
use Helpers\HTTP;

$data = json_decode($_POST['data'], true);
$table = new SaleTable(new MySQL());
for($i=0; $i<count($data); $i++){
    
    $myData = [
        "item_id" => $data[$i]["tbl_item_id"] ?? 'Unknown',
        "qty" => $data[$i]["tbl_qty"] ?? '0',
        "price" => $data[$i]["tbl_price"] ?? '0',
        "total" => $data[$i]["tbl_total"] ?? '0',
        "discount" => $data[$i]["tbl_discount"] ?? '0',
        "type" => $data[$i]["tbl_type"] ?? 'SA',
        "inv_discount" => $data[$i]["tbl_inv_discount"] ?? '0',
        "invoice" => $data[$i]["tbl_invoice"] ?? 'Unknown',
        "customer_id" => $data[$i]["tbl_customer_id"] ?? '1',
        "date" => $data[$i]["tbl_date"] ?? 'Unknown',
    ];

    if($table) {
        $table->insert($myData);
        HTTP::redirect("/sale/createSale.php", "inserted=true");
    } else {
        HTTP::redirect("/sale/index.php", "error=true");
    }
}