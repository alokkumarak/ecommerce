<?php

require('top.inc.php');
$categories = "";
$msg = "";
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM categories WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $categories = $row['categories'];
    } 
    else {
        header('location: categories.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $categories = get_safe_value($con, $_POST['categories']);

    $res = mysqli_query($con, "SELECT * FROM categories WHERE categories='$categories'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {

            } 
            else {
                $msg = "This category is already exist !";
            }
        }
         else {
            $msg = "This category is already exist !";
        }
    }
    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($con, "UPDATE categories SET categories='$categories' WHERE id='$id'");
        } else {
            mysqli_query($con, "INSERT INTO categories(categories,status) VALUES('$categories','1')");
        }
        header('location: categories.php');
        die();
    }
}




?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-8 m-auto">
                <div class="card">
                    <div class="card-header"><strong>New</strong><small> category</small></div>
                    <form method="post">
                        <div class="card-body card-block">
                            <div class="form-group"><label for="categories" class=" form-control-label">Category Name</label>
                                <input type="text" name="categories" placeholder="Enter category name" class="form-control" required value="<?php echo $categories ?>">
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