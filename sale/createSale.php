<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\ItemsTable;
use Libs\Database\CustomerTable;
use Libs\Database\SaleTable;
use Helpers\Auth;

$table = new ItemsTable(new MySQL());
$table2 = new SaleTable(new MySQL());
$table3 = new CustomerTable(new MySQL());
$all = $table->getAll();
$all2 = $table3->getAll();
$inv = $table2->getInvoice();
foreach($inv as $invoice){
    $inv = $invoice->invoice;
    $invNO = explode("/", $inv);
    $invoiceNO = "RR/".str_pad(($invNO[1]+1), 4, '0', STR_PAD_LEFT);;   
}
$auth = Auth::check();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        .wrap {
            width: 100%;
            max-width: 800px;
            margin: 40px auto;
        }
        .wrap2 {
            width: 100%;
            max-width: 800px;
            margin: 40px auto;
        }             
        table {
            table-layout: fixed;
            word-wrap: break-word;
        }
        table td {
        position: relative;
        }

        table td input {
        position: absolute;
        display: block;
        top:0;
        left:0;
        margin: 0;
        height: 100%;
        width: 100%;
        border: 1px solid black;
        border-radius: 3px;
        padding: 10px;
        box-sizing: border-box;
        }

        /* table.table-bordered > tbody > tr > td{
            border:1px solid blue;
        } */
    </style>
</head>
<body style="background-color: #AEAEAE;">
    <div class="pl-5 pr-5">
        <div class="">
            <div style="float: right" class="mt-2">            
                <a href="../sale/index.php" class="btn btn-sm btn-primary">Sale List</a> | 
                <a href="../_actions/logout.php" class="btn btn-sm btn-danger">Logout</a>
            </div>
            <h1 class="mt-3 mb-3 text-white">
                Sale
            </h1>
        </div>
        <div class="row mt-5">            
                        
        </div>
        <div class="row mt-2">
            <div class="col-8">
                <select id="customer" name="customer_id" class="select-picker" data-width="50%" data-live-search="true">
                <?php foreach($all2 as $customer): ?>
                    <option class="option" value="<?= $customer->id ?>"><?= $customer->name ?></option>
                <?php endforeach; ?>
                </select> 
            </div>            
            <div class="col">
                <input type="text" name="invno" id="invno" value="<?php echo $invoiceNO ?>" readonly />
                <input type="date" name="sdate" id="sdate" value="<?php echo date('Y-m-d'); ?>" readonly />
            </div>            
        </div>
        <div class="row mt-3">
            <div class="col-lg-3 bg-white">
                <div class="mt-3">
                    <label for="pType">
                        Sale Type :
                    </label>
                    <select id="pType" name="pType" class="select-picker" data-width="50%" data-live-search="true" required>                    
                        <option value="retail_one" selected>Retail</option>
                        <option value="whole_one">W1</option>
                        <option value="whole_two">W2</option>
                        <option value="whole_three">W3</option>
                        <option value="whole_four">W4</option>
                        <option value="whole_five">W5</option>
                    </select>                        
                </div>
            </div>
            <div class="col-lg-7 bg-white">                
                <div class="mt-3">     
                    Item : 
                    <select id="item" name="item_id" class="select-picker" data-width="50%" data-live-search="true">
                        <option value="">###</option>
                    <?php foreach($all as $item): ?>
                        <option class="option" value="<?= $item->id ?>"><?= $item->brand ?> | <?= $item->model ?> | <?= $item->sub_category_name ?></option>
                    <?php endforeach; ?>
                    </select>                        
                </div>
            </div>
            <div class="col-lg-2 bg-white">
                <div class="mt-3">
                    <button id="search" class="btn btn-outline-success w-100" disabled>Add</button>
                </div>
            </div>
            
        </div>
        <div class="row">            
            <div class="col bg-white">
                <div class="mt-5 w-100">
                    <table id="data" class="table table-bordered"></table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col bg-white" style="border-color: black;">
                <div class="mt-5 w-100">
                    <table id="GTotal" class="table table-bordered">
                        <tr>
                            <td colspan="8" style="text-align: right;"><b>Discount : </b></td>
                            <td><input type="text" id="Gdiscount" placeholder="0"></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right;"><b>Total : </b></td>
                            <td><input type="text" id="Gtotal" placeholder="0"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-10 bg-white"></div>
            <div class="col-lg-2 bg-white">
                <div class="mt-5 mb-5">
                    <button id="checkout" class="btn btn-success w-100">Checkout</button>
                </div>
            </div>
        </div>
    </div>
    

    
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $('select').selectpicker();

        $(document).ready(function(){
            $('#item').change(()=>{
                $('#search').prop('disabled', false);
            });

            $('#Gtotal').prop('readonly', true);

            let GtotalFunc = () => {
                var TotalValue = 0;
                $("#data tr").each(function(){
                    TotalValue += parseFloat($(this).find('.total').val());
                });
                return TotalValue;
            }             

            $('#search').click(function(e){
                e.preventDefault();
                let item_id = $('#item').val();   
                let pType = $('#pType').val();                        
                $.ajax({
                    type: "post",
                    url : "../_actions/sale/getOne.php",
                    data : 'item_id='+item_id+'&pType='+pType,
                    success: (response)=>{
                        // alert(response)
                        let data = JSON.parse(response);
                        data.map((item)=>{
                            $("#data").append(
                                `<tr>
                                    <td colspan="5"><input type="hidden" class="item_id" value="${item.item_id}">(${item.Brand} ${item.Model}) (${item.Subname})</td>                            
                                    <td><input type="text" class="quantity" id="qty_${item.item_id}" placeholder="0"></td>
                                    <td><input type="text" class="price" id="price_${item.item_id}" value="${item.price}" readonly></td>
                                    <td><input type="text" class="discount" id="dis_${item.item_id}" placeholder="0"></td>
                                    <td><input type="text" class="total" id="total_${item.item_id}" readonly placeholder="0"></td>
                                </tr>`
                                );
                        });                        
                        $('#search').prop('disabled', true);
                        
                        $(".quantity").on("input", function() {
                            let id = $(this).attr("id");
                            let key = id.split("_");
                            let price = $(`#price_${key[1]}`).val();
                            let qty = $(`#qty_${key[1]}`).val();
                            let total = price * qty;
                            $(`#total_${key[1]}`).val(total);
                            $('#Gtotal').val(GtotalFunc());
                        });

                        $(".discount").on("input", function() {
                            let id = $(this).attr("id");
                            let key = id.split("_");
                            let qty = $(`#qty_${key[1]}`).val();
                            let price = $(`#price_${key[1]}`).val();
                            let dis = $(`#dis_${key[1]}`).val();
                            let total = (price - dis) * qty;
                            $(`#total_${key[1]}`).val(total);
                            $('#Gtotal').val(GtotalFunc());
                        });
                        
                        $("#Gdiscount").on("input", function() {
                            let Gtotal = GtotalFunc();
                            let Gdiscount = $(this).val();
                            let Ftotal = Gtotal - Gdiscount;
                            $('#Gtotal').val(Ftotal);                        
                        });

                        
                    }
                });                  
            });

            $('#checkout').click(()=>{
                let tbl_item_id, tbl_qty, tbl_price, tbl_discount, tbl_total;
                let tbl_type = 'SA';
                let tbl_customer_id = $('#customer').val();
                let tbl_invoice = $('#invno').val();
                let tbl_inv_discount = $('#Gdiscount').val();
                let tbl_date = $('#sdate').val();
                let rowData = [];                           
                $("#data tr").each(function(){                    
                    tbl_item_id = $(this).find('.item_id').val();
                    tbl_qty = $(this).find('.quantity').val();
                    tbl_price = $(this).find('.price').val();
                    tbl_discount = $(this).find('.discount').val() || 0;
                    tbl_total = $(this).find('.total').val();
                    rowData.push({tbl_item_id, tbl_qty, tbl_price, tbl_discount, tbl_total, tbl_type, tbl_inv_discount, tbl_invoice,tbl_customer_id, tbl_date});
                });

                $.ajax({
                    type: "post",
                    url : "../_actions/sale/create.php",
                    data : 'data='+JSON.stringify(rowData),
                    success: (response)=>{
                        window.location.reload();
                        // console.log(response)
                    }
                }); 

            });

            
        });
    </script>
</body>
</html>