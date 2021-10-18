<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\ItemsTable;

use Helpers\Auth;

$items = new ItemsTable(new MySQL());
$item_all = $items->getAll();

$auth = Auth::check();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Price</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
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
        <h1 class="h3 mb-3">Create New Price</h1>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-warning">
                Cannot create new Price. Please try again.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['inserted'])): ?>
            <div class="alert alert-success">
                Successfully created
            </div>
        <?php endif; ?>

        <form action="../_actions/price/create.php" method="post">
            <select name="item_id" class="form-control mb-2" aria-label="Default select example" data-live-search="true" required>
            <option selected disabled>Select Items Here ...</option>
            <?php foreach($item_all as $item): ?>
            <option value="<?= $item->id ?>"><?= $item->brand ?> | <?= $item->model ?> | <?= $item->sub_category_name ?></option>
            <?php endforeach; ?>
            </select>
            <input type="number" name="retail1" class="form-control mb-2" placeholder="Retail" required>
            <input type="number" name="w1" class="form-control mb-2" placeholder="Wholesale-1" required>
            <input type="number" name="w2" class="form-control mb-2" placeholder="Wholesale-2" required>
            <input type="number" name="w3" class="form-control mb-2" placeholder="Wholesale-3" required>
            <input type="number" name="w4" class="form-control mb-2" placeholder="Wholesale-4" required>
            <input type="number" name="w5" class="form-control mb-2" placeholder="Wholesale-5" required>
            <button class="w-100 btn btn-primary">Save</button>
        </form>
        <br>
        <a href="../price/index.php" class="w-100 btn btn-outline-danger">Go Back</a>
    </div>
    
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $('select').selectpicker();
    </script>
</body>
</html>