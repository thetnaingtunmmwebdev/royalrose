<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\ItemsTable;
use Helpers\Auth;

$table = new ItemsTable(new MySQL());
$all = $table->getAll();

$auth = Auth::check();

json_encode($all);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css">
</head>
<body style="background : #eeeeee;">
    <div class="container bg-white p-5 mt-3">
        <div style="float: right" class="mt-2">
            <a href="createItem.php" class="btn btn-sm btn-outline-success">New</a> | 
            <a href="../profile.php" class="btn btn-sm btn-outline-primary">Main Menu</a> | 
            <a href="../_actions/logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
        </div>

        <h1 class="mb-3">
            Items
            <span class="badge bg-primary text-white">
                <?= count($all) ?>
            </span>
        </h1>

        <table id="example" class="table table-bordered table-hover responsive nowrap" style="width: 100%">
            <thead>
                <tr class="bg-primary text-white">
                    
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <!-- <th>Status</th> -->
                    <!-- <th></th> -->
                </tr>
            </thead>
            
        </table>
    </div>
    
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#example').dataTable({
            // "processing": true,
            "ajax": "../_actions/items/fetch.php",
            "columns": [
                {data: 'brand'},
                {data: 'model'},
                {data: 'category_name'},
                {data: 'sub_category_name'},
            ],
            "order": [[ 1, "desc" ]]
        });
    });
    </script>
</body>
</html>