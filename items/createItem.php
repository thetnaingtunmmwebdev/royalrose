<?php

include("../vendor/autoload.php");

use Libs\Database\CategoriesTable;
use Libs\Database\SubCategoriesTable;
use Helpers\Auth;
use Libs\Database\MySQL;

$categories = new CategoriesTable(new MySQL());
$cat_all = $categories->getAll();
$sub_categories = new SubCategoriesTable(new MySQL());
$sub_all = $sub_categories->getAll();

$auth = new Auth();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewItems</title>
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
        <h1 class="h3 mb-3">Create New Item</h1>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-warning">
                Cannot create new item. Please try again.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['inserted'])): ?>
            <div class="alert alert-success">
                Successfully created
            </div>
        <?php endif; ?>

        <form action="../_actions/items/create.php" method="post">
            <input type="text" name="brand" class="form-control mb-2" placeholder="Brand" required>
            <input type="text" name="model" class="form-control mb-2" placeholder="Model" required>
            <select name="category_id" class="form-select mb-2" aria-label="Default select example">
            <option selected disabled>Select Category Here ...</option>
            <?php foreach($cat_all as $category): ?>
            <option value="<?= $category->id ?>"><?= $category->name ?> | <?= $category->code ?></option>
            <?php endforeach; ?>
            </select>
            <select name="sub_category_id" class="form-select mb-2" aria-label="Default select example">
            <option selected disabled>Select Sub-Category Here ...</option>
            <?php foreach($sub_all as $sub): ?>
            <option value="<?= $sub->id ?>"><?= $sub->name ?> | <?= $sub->code ?></option>
            <?php endforeach; ?>
            </select>
            <button class="w-100 btn btn-primary">Save</button>
        </form>
        <br>
        <a href="../items/items.php" class="w-100 btn btn-outline-danger">Go Back</a>
    </div>
    
</body>
</html>