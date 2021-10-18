<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\ItemsTable;
use Helpers\Auth;
use Helpers\HTTP;

$auth = Auth::check();

$table = new ItemsTable(new MySQL());

$id = $_GET['id'];
$table->suspend($id);

HTTP::redirect("/items/items.php");