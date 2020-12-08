<?php

require('top.inc.php');


$sql="SELECT * FROM users ORDER BY id desc";
$res=mysqli_query($con,$sql);

?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-sm-6 ">
                        <h4 class="box-title"><b>Orders</b></h4>
                        </div>    
                    </div>
                    <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-remove"><span class="nobr">Order Id</span></th>
                                                <th class="product-thumbnail">Order Date</th>
                                                <th class="product-name"><span class="nobr">Address</span></th>
                                                <th class="product-price"><span class="nobr"> payment type </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> payment status </span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Order status</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           
                                                 $res=mysqli_query($con,"SELECT `order`.*,order_status.name as order_status_str FROM `order`,order_status WHERE  order_status.id=`order`.order_status");
                                                 while($row=mysqli_fetch_assoc($res)){
                                            ?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="order_detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a> </td>
                                                <td class="product-name"><?php echo $row['added_on'] ?></td>
                                                <td class="product-name"><?php echo $row['address'] ?><br>
                                                    <?php echo $row['city'] ?> <br><?php echo $row['pincode'] ?></td>
                                                <td class="product-name"><?php echo $row['payment_type'] ?></td>
                                                <td class="product-name"><?php echo $row['payment_status'] ?></td>
                                                <td class="product-name"><?php echo $row['order_status_str'] ?></td>
                                                
                                                
                                            </tr>
                                                 <?php } ?>
                                            
                                        </tbody>
                                        
                                    </table>
                                </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.inc.php');


?>