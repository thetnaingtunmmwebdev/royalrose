<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\SubCategoriesTable;
use Helpers\Auth;
use Helpers\HTTP;

$auth = Auth::check();

$table = new SubCategoriesTable(new MySQL());

$id = $_GET['id'];
$table->suspend($id);

HTTP::redirect("/sub_categories/index.php");