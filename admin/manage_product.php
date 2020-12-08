<?php

require('top.inc.php');
$categories_id = '';
$name = '';
$mrp = '';
$price = '';
$qty = '';
$image = '';
$short_desc = '';
$description = '';
$meta_title = '';
$meta_desc = '';
$meta_keyword = '';

$msg='';
$image_required='required';
if (isset($_GET['id']) && $_GET['id'] != '') {

    $image_required='';

    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM product WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $categories_id = $row['categories_id'];
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        $short_desc = $row['short_desc'];
        $description = $row['description'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
        $meta_keyword = $row['meta_keyword'];
        
    } else {
        header('location: product.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $categories_id = get_safe_value($con, $_POST['categories_id']);
    $name = get_safe_value($con, $_POST['name']);
    $mrp = get_safe_value($con, $_POST['mrp']);
    $price = get_safe_value($con, $_POST['price']);
    $qty = get_safe_value($con, $_POST['qty']);
    $short_desc = get_safe_value($con, $_POST['short_desc']);
    $description = get_safe_value($con, $_POST['description']);
    $meta_title = get_safe_value($con, $_POST['meta_title']);
    $meta_desc = get_safe_value($con, $_POST['meta_desc']);
    $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);
    

    $res = mysqli_query($con, "SELECT * FROM product WHERE name='$name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "This product is already exist !";
            }
        } else {
            $msg = "This product is already exist !";
        }
    }
    
    if($_FILES['image']['type'] !='' && ($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg')){
        $msg="Please select only png, jpg or jpeg formet of image !!";
    }

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            if($_FILES['image']['name']!=''){
                $image=rand(111111,999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
               $update_sql="UPDATE product SET categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',
               short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image' WHERE id='$id'";
            }
            else{
                $update_sql="UPDATE product SET categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',
                short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' WHERE id='$id'";
            }
            mysqli_query($con,$update_sql);
        } else {
            $image=rand(111111,999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);

            mysqli_query($con, "INSERT INTO product(categories_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image)
             VALUES('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword','1','$image')");
        }
       header('location: product.php');
        die();
    }
}

?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-8 m-auto">
                <div class="card">
                    <div class="card-header"><strong>New</strong><small> Product</small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group"><label for="categories" class=" form-control-label">Category</label>
                                <select class=" form-control" name="categories_id">
                                    <option>select category</option>
                                    <?php
                                    $res = mysqli_query($con, "SELECT id,categories FROM categories ORDER BY categories desc");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        if($row['id']==$categories_id){
                                            echo "<option selected value=" . $row['id'] . ">" . $row['categories'] . "</option>";
                                        }
                                        else{
                                            echo "<option value=" . $row['id'] . ">" . $row['categories'] . "</option>";
                                        }
                                        
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group"><label for="name" class=" form-control-label">Product Name</label>
                                <input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name ?>">
                            </div>
                            <div class="form-group"><label for="mrp" class=" form-control-label">MRP</label>
                                <input type="text" name="mrp" placeholder="Enter product's MRP " class="form-control" required value="<?php echo $mrp ?>">
                            </div>
                            <div class="form-group"><label for="price" class=" form-control-label">Price</label>
                                <input type="text" name="price" placeholder="Enter price" class="form-control" required value="<?php echo $price ?>">
                            </div>
                            <div class="form-group"><label for="qty" class=" form-control-label">Qty</label>
                                <input type="number" name="qty" placeholder="Enter Quentity" class="form-control" required value="<?php echo $qty ?>">
                            </div>
                            <div class="form-group"><label for="image" class=" form-control-label">Image</label>
                                <input type="file" name="image" class="form-control" <?php echo $image_required ?>>
                            </div>
                            <div class="form-group"><label for="short_desc" class=" form-control-label">short Description</label>
                              <textarea type="text" name="short_desc" placeholder="Enter short description" class="form-control" required><?php echo $short_desc ?></textarea>
                            </div>
                            <div class="form-group"><label for="description" class=" form-control-label">Description</label>
                                <textarea type="text" name="description" placeholder="Enter description" class="form-control" required><?php echo $description ?></textarea>
                            </div>
                            <div class="form-group"><label for="meta_title" class=" form-control-label">meta title</label>
                                <textarea type="text" name="meta_title" placeholder="Enter meta title" class="form-control"><?php echo $meta_title ?></textarea>
                            </div>
                            <div class="form-group"><label for="meta_desc" class=" form-control-label">meta description</label>
                                <textarea type="text" name="meta_desc" placeholder="Enter meta description" class="form-control" ><?php echo $meta_desc ?></textarea>
                            </div>
                            <div class="form-group"><label for="meta_keyword" class=" form-control-label">meta keyword</label>
                                <textarea type="text" name="meta_keyword" placeholder="Enter meta keyword" class="form-control" ><?php echo $meta_keyword ?></textarea>
                            </div>
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-warning btn-block">
                                <span id="payment-button-amount" name="submit">Submit</span>
                            </button>
                            <div class="text-danger mt-2"><?php echo $msg  ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.inc.php');


?>