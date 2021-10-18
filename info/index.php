<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\ItemsTable;
use Helpers\Auth;

$table = new ItemsTable(new MySQL());
$all = $table->getModel();

$auth = Auth::check();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        .wrap {
            width: 100%;
            max-width: 400px;
            margin: 40px auto;
        }        
        table {
            table-layout: fixed;
            word-wrap: break-word;
        }
    </style>
</head>
<body style="background-color: #404040;">
    <div class="container">
        <div style="float: right" class="mt-2">
            <a href="../profile.php" class="btn btn-sm btn-primary">Main Menu</a> | 
            <a href="../_actions/logout.php" class="btn btn-sm btn-danger">Logout</a>
        </div>
        <h1 class="mt-3 mb-3 text-white">
            Info
        </h1>
        
        <div class="mt-5 wrap">     
            <select id="item" name="item_id" class="select-picker show-tick w-100" data-live-search="true">
            <option selected disabled>Select Items Here ...</option>
            <?php foreach($all as $item): ?>
                <option class="option" value="<?= $item->brand ?>,<?= $item->model ?>"><?= $item->brand ?> | <?= $item->model ?></option>
            <?php endforeach; ?>
            </select>            
            <button id="search" class="btn btn-sm btn-success mt-2 w-100" disabled>Find</button>
            <button class="btn btn-sm btn-danger mt-2 w-100" onClick="reset()">Reset</button>
        </div>
        <div class="mt-5 wrap">
            <table id="data" class="table table-bordered text-white"></table>
        </div>
    </div>
    

    
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $('select').selectpicker();

        function reset() {
            window.location.reload();
        }

        $(document).ready(function(){
            $('#item').change(()=>{
                $('#search').prop('disabled', false);
            });

            $('#search').click(function(e){
                e.preventDefault();
                let item = $('#item').val();
                let [brand, model] = item.split(",");
                        
                $.ajax({
                    type: "post",
                    url : "../_actions/info/getOne.php",
                    data : 'brand='+brand+'&model='+model,
                    success: (response)=>{
                        let data = JSON.parse(response);
                        data.map((item)=>{
                            $("#data").append(
                                `<tr>
                                    <td colspan="5">(${item.brand} ${item.model}) (${item.Subname})</td>
                                    <td>${item.Qty}</td>
                                </tr>
                                <tr>                        
                                    <td>${item.R1}</td>
                                    <td>${item.W1}</td>
                                    <td>${item.W2}</td>
                                    <td>${item.W3}</td>
                                    <td>${item.W4}</td>
                                    <td>${item.W5}</td>
                                </tr>`
                                );
                        });                        
                        $('#search').prop('disabled', true);
                    }
                });                
            });
        });
    </script>
</body>
</html>