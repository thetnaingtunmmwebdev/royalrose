<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\CategoriesTable;
use Helpers\Auth;
use Helpers\HTTP;

$auth = Auth::check();

$table = new CategoriesTable(new MySQL());

$id = $_GET['id'];
$table->unsuspend($id);

HTTP::redirect("/categories/index.php");