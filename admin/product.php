<?php

require('top.inc.php');
if(isset($_GET['type']) && $_GET['type']!=''){
    $type=get_safe_value($con,$_GET['type']);

    if($type=='status'){
    $operation=get_safe_value($con,$_GET['operation']);
    $id=get_safe_value($con,$_GET['id']);
       if($operation=='active'){
              $status='1';
       }
       else{
        $status='0';      
       }

        $update_status_sql="UPDATE product SET status='$status' WHERE id='$id'";
        mysqli_query($con,$update_status_sql);
    }

    if($type=='delete'){
        $id=get_safe_value($con,$_GET['id']);
        $delete_sql="DELETE FROM product WHERE id='$id'";
        mysqli_query($con,$delete_sql);
      }
}
$sql="SELECT product.*,categories.categories FROM product,categories WHERE product.categories_id=categories.id ORDER BY product.id desc";
$res=mysqli_query($con,$sql);

?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-sm-6 ">
                        <h4 class="box-title"><b>Products</b></h4>
                        </div>
                        <div class="col-sm-6 text-right">
                        <button class="btn btn-warning "><a href="manage_product.php" class="text-light"><i class="fa fa-plus" aria-hidden="true"></i> Add Product</a></button>
                        </div>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        
                                        
                                        <th>status</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                
                                     while($row=mysqli_fetch_assoc($res)){ ?>
                                    <tr>
                                    
                                       
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['categories'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"/></td>
                                        <td><?php echo $row['mrp'] ?></td>
                                        <td><?php echo $row['price'] ?></td>
                                        <td><?php echo $row['qty'] ?></td>
                                        
                                        
                                        <td>

                                            <?php 
                                              echo "<span class='badge btn-info'><a href='manage_product.php?id=".$row['id']."' class='text-light'>Edit</a>&nbsp;</span>&nbsp;&nbsp;";
                                               
                                               if($row['status']==1){
                                                   echo "<span class='badge btn-success'><a href='?type=status&operation=deactive&id=".$row['id']."' class='text-light'>Active</a></span>&nbsp;&nbsp;";
                                               }
                                               else{
                                                echo "<span class='badge btn-secondary'><a href='?type=status&operation=active&id=".$row['id']."' class='text-light'>Deactive</a></span>&nbsp;";
                                               }
                                               echo "<span class='badge btn-danger'><a href='?type=delete&id=".$row['id']."' class='text-light'>Delete</a></span>";

                                            ?>

                                        </td>
                                    </tr>
                                    
                                    <?php  } ?>
                                   
                                  
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