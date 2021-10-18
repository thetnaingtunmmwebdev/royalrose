<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\CustomerTable;
use Helpers\Auth;
use Helpers\HTTP;

$auth = Auth::check();

$table = new CustomerTable(new MySQL());

$id = $_GET['id'];
$table->delete($id);

HTTP::redirect("/customers/index.php");