<?php 
require ("top.inc.php");
$categories = '';
$msg = '';
if(isset($_GET['id']) && $_GET['id']!=''){
    $id = get_safe_value($con,$_GET['id']);
    $res = mysqli_query($con,"select * from categories where id='$id'");
    $check = mysqli_num_rows($res);
    if($check>0){
        $row = mysqli_fetch_assoc($res);
        $categories = $row['categories']; 
    }else{
        header("location: categories.php");
        die();
    }
}

if(isset($_POST['submit'])){
    $categories = get_safe_value($con,$_POST['categories']);
    $res = mysqli_query($con,"select * from categories where categories='$categories'");
    $check = mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData = mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg = "Categories already exist.";
            }
        }else{
            $msg = "Categories already exist.";
        }
    }

    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            mysqli_query($con,"update categories set categories='$categories' where id='$id'");
        }else{
            mysqli_query($con,"insert into categories(categories,status) values('$categories','1')");
        }
        header("location: categories.php");
        die();
    }
}
?>

<div class="col-sm-9 gap mx-auto my-4">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>Categories </strong><small>Form</small></div>
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label>Categories</label>
                        <input type="text" name="categories" class="form-control" placeholder="Enter categories name" value="<?php echo $categories ?>" required>
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