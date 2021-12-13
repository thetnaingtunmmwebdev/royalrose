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
    <link rel="stylesheet" href="../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css">
</head>
<body>
    <div class="container p-5">
        <div style="float: right">
            <div class="row">
                <div class="col">
                    <a href="createItem.php">
                        <button type="button" class="btn btn-outline-success w-100 h-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                        
                        </button>
                    </a>
                </div>
                <div class="col">
                    <a href="../profile.php">
                        <button class="btn btn-outline-primary w-100 h-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        
                        </button>
                    </a>
                </div>
                <div class="col">
                    <a href="../_actions/logout.php" >
                        <button class="btn btn-outline-danger w-100 h-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                        </svg>
                        
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <h1 class="mb-3">           
            Items
            <!-- <span class="badge bg-primary text-white">
                <?= count($all) ?>
            </span> -->
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