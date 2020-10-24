<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="mainbg">

    <div class="mainpanel">
        <div class="Title">Pre-Order Your SUB by 8:30am</div>
        <div class="subtitle">Late order are not accepted</div>
        <div class="subsubtitle">Orders not picked up will not be allowed to pre order again</div>

        <div class="formupdate">
            <div class="inputpanel">
                <div class="inputpromt">
                    First and Last Name:
                </div>
                <div class="inputvalue">
                    <input type="text" class="customer_name inputclass" />
                    <input type="text" class="cart_id" value="<?php echo date("dmY") . uniqid()?>" style="display:none" />
                </div>
            </div>
            <div class="inputpanel">
                <div class="inputpromt">
                    Date:
                </div>
                <div class="inputvalue">
                    <input type="date" class="dateorder inputclass" />
                </div>
            </div>
            <div class="inputpanel">
                <div class="inputpromt">
                    Email:
                </div>
                <div class="inputvalue">
                    <input type="email" class="customer_email inputclass" />
                </div>
            </div>
            <div class="inputpanel">
                <div class="inputpromt">
                    <input type="button" value="Submit" class="submitbutton">
                </div>
            </div>
        </div>
        <div class="Orderprompt">Choose your order:</div>
        <div class="ordercontent"></div>
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

                        var obj = jQuery.parseJSON( data.responseText );
                        
                        var prevecateg = '';
                        Object.keys(obj.records).forEach(function(key) {
                            // obj.records[key]['product_id']
                        if(prevecateg==''){
                        $('.ordercontent').append('<div class="foodpanel div_'+obj.records[key]['product_category']+'"><div class="foodtitle">#'+obj.records[key]['product_category']+' '+obj.records[key]['category_name']+'</div><div class="productlists" data-id="'+obj.records[key]['product_id']+'">'+obj.records[key]['product_name']+'</div>');
                        prevecateg = obj.records[key]['product_category'];
                        }else if(prevecateg != obj.records[key]['product_category']){
                        $('.ordercontent').append('</div><div class="foodpanel div_'+obj.records[key]['product_category']+'"><div class="foodtitle">#'+obj.records[key]['product_category']+' '+obj.records[key]['category_name']+'</div><div class="productlists" data-id="'+obj.records[key]['product_id']+'">'+obj.records[key]['product_name']+'</div>');
                        prevecateg = obj.records[key]['product_category'];
                        }else{
                        $('.div_'+obj.records[key]['product_category']).append('<div class="productlists" data-id="'+obj.records[key]['product_id']+'">'+obj.records[key]['product_name']+'</div>');
                        prevecateg = obj.records[key]['product_category'];
                        }
                        });
                        
                        $('.ordercontent').append('</div>');
                    }
                });
            }

            initialtable();

            
            $( ".ordercontent" ).on( "click", ".productlists", function() {

                if($(this).hasClass('active'))
                    $(this).removeClass('active');
                else
                    $(this).addClass('active');
            });

            $(".submitbutton").click(function(){
                var customer_name = $('.customer_name').val();
                var customer_email = $('.customer_email').val();
                var product_id = '';
                var cart_id = $('.cart_id').val();
                var dateorder = $('.dateorder').val();

                    $(".active").each(function(){
                        product_id = $(this).attr("data-id") + ',' + product_id; //this.id
                        });

                product_id = product_id.slice(0,-1);
                console.log(product_id);
                var js_obj = {'customer_name':customer_name,'customer_email':customer_email,'product_id':product_id,'cart_id':cart_id,'dateorder':dateorder};
                    var encoded = JSON.stringify( js_obj );

                    var data= encoded;

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "order/create.php",
                        data:data,
                        complete: function(data) {
                                console.log(data);
                                var obj = jQuery.parseJSON( data.responseText );
                                alert('Order Sent!');
                                location.reload(true);
                            }
                        });

            });

        });
        </script>

    </body>
</html>