<?php
include("vendor/autoload.php");

use Helpers\Auth;

$auth = Auth::check();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-5">
            <?= $auth->name ?>
            <span class="fw-normal text-muted">
                (<?= $auth->role ?>)
            </span>
        </h1>

        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-warning">
                Cannot Upload File
            </div>
        <?php endif; ?>

        <!-- <?php if($auth->photo): ?>
            <img src="_actions/photos/<?= $auth->photo ?>" alt="Profile Photo" class="img-thumbnail mb-3" width="200">
        <?php endif; ?>

        <form action="_actions/upload.php" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="file" name="photo" class="form-control">
                <button class="btn btn-secondary">Upload</button>
            </div>
        </form> -->
        
        <!-- <ul class="list-group">
            <li class="list-group-item">
                <b>Email:</b> <?= $auth->email ?>
            </li>
            <li class="list-group-item">
                <b>Phone:</b> <?= $auth->phone ?>
            </li>
            <li class="list-group-item">
                <b>Address:</b> <?= $auth->address ?>
            </li>
        </ul> -->
        <br>

        <a href="customers/index.php" class="btn btn-outline-primary">Customers</a> | 
        <a href="items/items.php" class="btn btn-outline-primary">Items</a> | 
        <a href="categories/index.php" class="btn btn-outline-primary">Categories</a> | 
        <a href="sub_categories/index.php" class="btn btn-outline-primary">Sub-Categories</a> | 
        <a href="stockOpening/index.php" class="btn btn-outline-primary">Stock</a> | 
        <a href="price/index.php" class="btn btn-outline-primary">Price</a> | 
        <a href="info/index.php" class="btn btn-outline-primary">Info</a> | 
        <a href="sale/index.php" class="btn btn-outline-primary">Sale</a> | 
        <a href="_actions/logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
    
</body>
</html>