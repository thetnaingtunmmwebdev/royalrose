<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\CustomerTable;
use Helpers\Auth;

$table = new CustomerTable(new MySQL());
$all = $table->getAll();

$auth = Auth::check();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../css/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <div style="float: right" class="mt-2">  
            <div class="row">
                <div class="col">
                    <a href="createCustomer.php">
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
            Customers
            <!-- <span class="badge bg-danger text-white">
                <?= count($all) ?>
            </span> -->
        </h1>

        <table id="example" class="table table-bordered table-hover" style="width: 100%">
            <thead>
                <tr class="bg-primary text-white">
                    <th>ID</th>
                    <th>Name</th>                    
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($all as $customer): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $customer->name ?></td>
                        <!-- <td>
                            <?php if($customer->status): ?>
                                <a href="../_actions/categories/suspended.php?id=<?= $customer->id ?>" class="btn btn-sm btn-outline-success">Active</a>
                            <?php else: ?>
                                <a href="../_actions/categories/unsuspend.php?id=<?= $customer->id ?>" class="btn btn-sm btn-danger">Suspended</a>
                            <?php endif; ?>
                        </td> -->
                        <!-- <td>
                            <?php if($auth->value > 1): ?>
                                <div class="btn-group dropdown">
                                    <a href="#" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                                    <div class="dropdown-menu dropdown-menu-dark">
                                        <a href="#" class="dropdown-item">Edit</a>
                                        <a href="../_actions/categories/delete.php?id=<?= $category->id ?>" class="dropdown-item">Delete</a>                        
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
    
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "pagingType": "full_numbers"
            });
        } );
    </script>
</body>
</html>