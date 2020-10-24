
<?php
session_start();
if(isset($_POST['username'])){
    if($_POST['username']=='mainadmin' && $_POST['password']=='@dM1nL0g')
    {
        $_SESSION['token']='6be198e4aee44ab65fba820629b79154';
    }
    else{
        echo 'wrong username or password';
    }
}
?>
<html>
    
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>

        <?php if(isset($_SESSION['token'])){
            if($_SESSION['token']=='6be198e4aee44ab65fba820629b79154'){
            ?>

        <a href="logout.php" class="logout">Logout</a>

        <div class="mainnavig">
                <div class="navig navig1">Products</div><div class="navig navig2">Orders</div>
        </div>

        <div class="panels productpanel">
            <div class="inputform">
            <table id="myTable" border="1" cellspacing="0" cellpadding="4">
            </table>
            <table id="inputtable" border="1" cellspacing="0" cellpadding="4">
                <tr>
                    <td>
                        Category
                    </td>
                    <td>
                        <input type="text" style="display:none" class="product_id inputclass" />
                        <select name="category" class="product_category inputclass">
                            <option value="1">Bread</option>
                            <option value="2">Sauce</option>
                            <option value="3">Sandwich Types</option>
                            <option value="4">Cheese</option>
                            <option value="5">Veggies</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Product Name
                    </td>
                    <td>
                        <input type="text" class="product_name inputclass" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Product Price
                    </td>
                    <td>
                    <input type="number" class="product_price inputclass" />
                    </td>
                </tr>
                <tr>
                    <td>
                <input type="button" class="submitbutton" value="submit">
                    </td>
                    <td>
                    </td>
                </tr>
            </table>
            </div>

        </div>
        
        <div class="panels orderpanel">
            <table id="myTable2" border="1" cellspacing="0" cellpadding="4">
            </table>
        </div>

        <script>
        $(document).ready(function(){

            function initialtable(){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "product/read.php",
                    // data: "action=loadall&id=" + id,
                    complete: function(data) {

                        $('#myTable').html('');
                        $('#myTable').append('<tr><th>Product ID</th><th>Product Category</th><th>Product Name</th><th>Product Price</th><th>Date Added</th><th colspan=2>Actions</th></tr>');

                        var obj = jQuery.parseJSON( data.responseText );
                        
                        Object.keys(obj.records).forEach(function(key) {
                        
                        $('#myTable').append('<tr><td>'+obj.records[key]['product_id']+'</td><td>'+obj.records[key]['category_name']+'</td><td>'+obj.records[key]['product_name']+'</td><td>'+obj.records[key]['product_price']+'</td><td>'+obj.records[key]['dateadded']+'</td><td><div class="editlink" data-id="'+obj.records[key]['product_id']+'">Edit</div></td><td><div class="deletelink" data-id="'+obj.records[key]['product_id']+'">Delete</div></td></tr>');
                        });

                    }
                });
            }

            initialtable();


            function initialtable2(){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "order/read.php",
                    // data: "action=loadall&id=" + id,
                    complete: function(data) {

                        $('#myTable2').html('');
                        $('#myTable2').append('<tr><th>Order ID</th><th>Customer Name</th><th>Date Deliver</th><th>Customer Email</th><th>Product/s</th><th>Cart ID</th><th>Quantity</th><th>Total</th></tr>');

                        var obj = jQuery.parseJSON( data.responseText );
                        
                        Object.keys(obj.records).forEach(function(key) {
                        
                        $('#myTable2').append('<tr><td>'+obj.records[key]['order_id']+'</td><td>'+obj.records[key]['customer_name']+'</td><td>'+obj.records[key]['dateorder']+'</td><td>'+obj.records[key]['customer_email']+'</td><td>'+obj.records[key]['product_list']+'</td><td>'+obj.records[key]['cart_id']+'</td><td>'+obj.records[key]['order_num']+'</td><td>'+obj.records[key]['order_sum']+'</td></tr>');
                        });

                    }
                });
            }
            initialtable2();



            $( "#myTable" ).on( "click", ".deletelink", function() {
                    var product_id = $(this).attr('data-id');
                    
                    var js_obj = {'product_id':product_id};
                    var encoded = JSON.stringify( js_obj );

                    var data= encoded;

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "product/delete.php",
                        data:data,
                        complete: function(data) {
                                console.log(data);
                                initialtable();
                                var obj = jQuery.parseJSON( data.responseText );
                                alert(obj.message);
                            }
                        });
                });

            

            $( "#myTable" ).on( "click", ".editlink", function() {
                    var product_id = $(this).attr('data-id');
                    

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "product/read_one.php",
                        data:{'product_id':product_id},
                        complete: function(data) {
                                console.log(data);
                                initialtable();
                                var obj = jQuery.parseJSON( data.responseText );
                                $(".product_id").val(obj.product_id);
                                $(".product_category").val(obj.product_category);
                                $(".product_name").val(obj.product_name);
                                $(".product_price").val(obj.product_price);
                            }
                        });
                });

            $('.submitbutton').click(function(){
                    var product_id = $('.product_id').val();
                    var product_category = $('.product_category').val();
                    var product_name = $('.product_name').val();
                    var product_price = $('.product_price').val();
                    
                    if(product_id!=''){
                    var js_obj = {'product_id':product_id,'product_category':product_category,'product_name':product_name,'product_price':product_price};
                    var address = 'product/update.php';
                    }else{
                    var js_obj = {'product_category':product_category,'product_name':product_name,'product_price':product_price};
                    var address = 'product/create.php';
                    }
                    var encoded = JSON.stringify( js_obj );

                    var data= encoded;

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: address,
                        data:data,
                        complete: function(data) {
                                var obj = jQuery.parseJSON( data.responseText );
                                initialtable();
                                alert(obj.message);
                                
                                $(".product_id").val('');
                                $(".product_category").val('');
                                $(".product_name").val('');
                                $(".product_price").val('');
                            }
                        });
            });

            $('.navig1').click(function(){
                $('.productpanel').fadeIn();
                $('.orderpanel').hide();
            });
            $('.navig2').click(function(){
                $('.productpanel').hide();
                $('.orderpanel').fadeIn();
            });


        });
        </script>

        <?php
            }else{

                ?>
                <form action="" method="post">
                    Username:
                    <input type="text" name="username" /> <br>
                    Password:
                    <input type="text" name="password" /> <br>
                    <input type="submit">
                </form>
                <?php
            }
        
        }else{
            ?>
            <form action="" method="post">
                Username:
                <input type="text" name="username" /> <br>
                Password:
                <input type="text" name="password" /> <br>
                <input type="submit">
            </form>
            <?php
        }
        ?>

    </body>
</html>