<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\PriceTable;
use Helpers\Auth;
use Helpers\HTTP;

$auth = Auth::check();

$table = new PriceTable(new MySQL());

$id = $_GET['id'];
$table->delete($id);

HTTP::redirect("/price/index.php");