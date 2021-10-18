<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\CategoriesTable;

use Helpers\Auth;

$table = new CategoriesTable(new MySQL());
$all = $table->getAll();

$auth = Auth::check();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Sub Category</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        .wrap {
            width: 100%;
            max-width: 400px;
            margin: 40px auto;
        }
    </style>
</head>
<body class="text-center">
    <div class="wrap">
        <h1 class="h3 mb-3">Create New Sub-Category</h1>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-warning">
                Cannot create new sub-category. Please try again.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['inserted'])): ?>
            <div class="alert alert-success">
                Successfully created
            </div>
        <?php endif; ?>

        <form action="../_actions/sub_categories/create.php" method="post">
            <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
            <input type="text" name="code" class="form-control mb-2" placeholder="Code" required>
            <select name="category_id" class="form-select mb-2" aria-label="Default select example">
            <option selected disabled>Select Category Here ...</option>
            <?php foreach($all as $category): ?>
            <option value="<?= $category->id ?>"><?= $category->name ?> | <?= $category->code ?></option>
            <?php endforeach; ?>
            </select>
            <button class="w-100 btn btn-primary">Save</button>
        </form>
        <br>
        <a href="../sub_categories/index.php" class="w-100 btn btn-outline-danger">Go Back</a>
    </div>
    
</body>
</html>