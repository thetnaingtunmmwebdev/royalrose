<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\StockOpeningTable;
use Helpers\Auth;

$table = new StockOpeningTable(new MySQL());
$all = $table->getAll();

$auth = Auth::check();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../css/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <div style="float: right" class="mt-2">
            <div class="row">
                <div class="col">
                    <a href="createStockOpening.php">
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

        <h1 class="mt-3 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
            </svg>
            Stock Opening
            <span class="badge bg-danger text-white">
                <?= count($all) ?>
            </span>
        </h1>
        <div class="table-responsive">
        <table id="example" class="table table-bordered table-hover dt-responsive nowrap" style="width: 100%">
            <thead>
                <tr class="bg-primary text-white">
                    <th>ID</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Type</th>
                    <!-- <th>Status</th> -->
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($all as $stock): ?>
                    <tr id="mytr" class="">
                        <td><?= $i ?></td>
                        <td><?= $stock->brand ?> <?= $stock->model ?> (<?= $stock->SubName ?>)</td>
                        <td><?= $stock->qty ?></td>
                        <td><?= $stock->price ?></td>
                        <td><?= $stock->type ?></td>
    
                        <!-- <td>
                            <?php if($sub_categories->status): ?>
                                <a href="../_actions/sub_categories/suspended.php?id=<?= $sub_categories->id ?>" class="btn btn-sm btn-outline-success">Active</a>
                            <?php else: ?>
                                <a href="../_actions/sub_categories/unsuspend.php?id=<?= $sub_categories->id ?>" class="btn btn-sm btn-danger">Suspended</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($auth->value > 1): ?>
                                <div class="btn-group dropdown">
                                    <a href="#" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                                    <div class="dropdown-menu dropdown-menu-dark">
                                        <a href="#" class="dropdown-item">Edit</a>
                                        <a href="../_actions/sub_categories/delete.php?id=<?= $sub_category->id ?>" class="dropdown-item">Delete</a>                        
                                    </div>
                                </div>
                            <?php else: ?>
                                ###
                            <?php endif ?>
                        </td> -->
                    </tr>
                <?php $i++; endforeach; ?>      
            </tbody> 
        </table>
        </div>
    </div>
    
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "pagingType": "full_numbers",
            });
        } );
    </script>
</body>
</html>