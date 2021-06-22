<?php 
require ("top.inc.php");
$categories_id = '';
$name = '';
$mrp = '';
$quantity = '';
$image = '';
$description = '';

$msg = '';
$image_required = 'required';
if(isset($_GET['id']) && $_GET['id']!=''){
    $image_required = '';
    $id = get_safe_value($con,$_GET['id']);
    $res = mysqli_query($con,"select * from product where id='$id'");
    $check = mysqli_num_rows($res);
    if($check>0){
        $row = mysqli_fetch_assoc($res);
        $categories_id = $row['categories_id']; 
        $name = $row['name']; 
        $mrp = $row['mrp']; 
        $quantity = $row['quantity'];
        $description = $row['description'];
    }else{
        header("location: product.php");
        die();
    }
}

if(isset($_POST['submit'])){
    $categories_id = get_safe_value($con,$_POST['categories_id']);
    $name = get_safe_value($con,$_POST['name']);
    $mrp = get_safe_value($con,$_POST['mrp']);
    $quantity = get_safe_value($con,$_POST['quantity']);
    $description = get_safe_value($con,$_POST['description']);
    
    $res = mysqli_query($con,"select * from product where name='$name'");
    $check = mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData = mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg = "product already exist.";
            }
        }else{
            $msg = "product already exist.";
        }
    }
    
    if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
        $msg = "Please select only png,jpg and jpeg format.";
    }

    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            if($_FILES['image']['name']!=''){
                $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                $update_sql = "update product set categories_id='$categories_id',name='$name',quantity='$quantity',mrp='$mrp',description='$description', image='$image' where id='$id'";
            }else{
                $update_sql = "update product set categories_id='$categories_id',name='$name',quantity='$quantity',mrp='$mrp',description='$description' where id='$id'";
            }
            mysqli_query($con,$update_sql);
        }else{
            $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
            mysqli_query($con,"insert into product(categories_id,name,quantity,image,mrp,description,status) values('$categories_id','$name','$quantity','$image','$mrp','$description','1')");
        }
        header("location: product.php");
        die();
    }
}
?>

<div class="col-sm-9 mx-auto my-4">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>Product </strong><small>Form</small></div>
            <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Categories</label>
                        <select name="categories_id" class="form-control">
                            <option>Select Category</option>
                            <?php
                            $res=mysqli_query($con,"select id,categories from categories order by categories asc");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['id']==$categories_id){
                                    echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                }else{
                                    echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" value="<?php echo $name ?>" required>
                    </div>
                    <div class="form-group">
                        <label>MRP</label>
                        <input type="text" name="mrp" class="form-control" placeholder="Enter product mrp" value="<?php echo $mrp ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" name="quantity" class="form-control" placeholder="Enter quantity" value="<?php echo $quantity ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" <?php echo $image_required ?>>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control" placeholder="Enter product description" required><?php echo $description ?></textarea>
                    </div>
                    <button class="btn btn-primary btn-block" name="submit">Submit</button>
                    <div class="field_error mt-3"><?php echo $msg ?></div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php require ("footer.inc.php"); ?>
</body>
</html>