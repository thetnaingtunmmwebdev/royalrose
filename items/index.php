<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\ItemsTable;
use Helpers\Auth;

$table = new ItemsTable(new MySQL());
$all = $table->getAll();

$auth = Auth::check();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link href="https://unpkg.com/tabulator-tables@4.9.3/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.9.3/dist/js/tabulator.min.js"></script>    
</head>
<body>
    <div id="example-table"></div>

    <script>
        // var tabledata = [
        //         {id:1, name:"Oli Bob", age:"12", col:"red", dob:""},
        //         {id:2, name:"Mary May", age:"1", col:"blue", dob:"14/05/1982"},
        //         {id:3, name:"Christine Lobowski", age:"42", col:"green", dob:"22/05/1982"},
        //         {id:4, name:"Brendon Philips", age:"125", col:"orange", dob:"01/08/1980"},
        //         {id:5, name:"Margret Marmajuke", age:"16", col:"yellow", dob:"31/01/1999"},
        //     ];
            var tabledata = <?php echo json_encode($all); ?>;
            alert(tabledata)

            var table = new Tabulator("#example-table", {
            // height:205, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
            data:tabledata, //assign data to table
            layout:"fitColumns", //fit columns to width of table (optional)
            columns:[ //Define Table Columns
                {title:"brand", field:"brand", width:150},
                {title:"model", field:"model", hozAlign:"left"},
                {title:"category_id", field:"category_id", hozAlign:"left"},
                {title:"sub_category_id", field:"sub_category_id", hozAlign:"left"},
                {title:"status", field:"status", hozAlign:"left"},
                {title:"created_at", field:"created_at", hozAlign:"left"},
                {title:"updated_at", field:"updated_at", hozAlign:"left"},
                {title:"category_name", field:"category_name", hozAlign:"left"},
                {title:"sub_category_name", field:"sub_category_name", hozAlign:"left"},
                // {title:"Favourite Color", field:"category_name"},
                // {title:"Date Of Birth", field:"sub_category_name", hozAlign:"center"},
            ],
            rowClick:function(e, row){ //trigger an alert message when the row is clicked
                alert("Row " + row.getData().id + " Clicked!!!!");
            },
        });
    </script>
</body>
</html>