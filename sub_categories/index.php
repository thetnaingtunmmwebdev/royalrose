<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\SubCategoriesTable;
use Helpers\Auth;

$table = new SubCategoriesTable(new MySQL());
$all = $table->getAll();

$auth = Auth::check();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-Categories</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css">
</head>
<body>
    <div class="container">
        <div style="float: right" class="mt-2">
            <a href="createSubCategory.php" class="btn btn-sm btn-outline-success">New</a> | 
            <a href="../profile.php" class="btn btn-sm btn-outline-primary">Main Menu</a> | 
            <a href="../_actions/logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
        </div>

        <h1 class="mt-3 mb-3">
            Sub-Categories
            <span class="badge bg-danger text-white">
                <?= count($all) ?>
            </span>
        </h1>
        <div class="table-responsive">
        <table id="example" class="table table-bordered table-hover" style="width: 100%">
            <thead>
                <tr class="bg-primary text-white">
                    <th>ID</th>
                    <th>Name</th>
                    <!-- <th>Code</th> -->
                    <th>Category</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($all as $sub_categories): ?>
                    <tr id="mytr" class="">
                        <td><?= $i ?></td>
                        <td><?= $sub_categories->name ?></td>
                        <!-- <td><?= $sub_categories->code ?></td> -->
                        <td><?= $sub_categories->categoryName ?></td>
                        <td>
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
                        </td>
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
                "pagingType": "full_numbers"
            });
        } );
    </script>
</body>
</html>