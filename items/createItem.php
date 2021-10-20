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
    <link rel="stylesheet" href="../css/bootstrap-icons.css">
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
        <hr>
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
        <div class="row">
            <div class="col"><input type="text" name="brand" class="form-control mb-2" placeholder="Brand" required></div>
        </div>
        <div class="row">
            <div class="col"><input type="text" name="model" class="form-control mb-2" placeholder="Model" required></div>
        </div>
        <div class="row">
            <div class="col">
                <select name="category_id" class="form-select mb-2" aria-label="Default select example">
                <option selected disabled>Select Category Here ...</option>
                <?php foreach($cat_all as $category): ?>
                <option value="<?= $category->id ?>"><?= $category->name ?> | <?= $category->code ?></option>
                <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <select name="sub_category_id" class="form-select mb-2" aria-label="Default select example">
                <option selected disabled>Select Sub-Category Here ...</option>
                <?php foreach($sub_all as $sub): ?>
                <option value="<?= $sub->id ?>"><?= $sub->name ?> | <?= $sub->code ?></option>
                <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button class="w-100 btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
                </button>
            </div>
            <div class="col">
                <a href="../items/items.php" class="w-100 btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                </a>
            </div>
        </div>
        </form>
    </div>
    
</body>
</html>