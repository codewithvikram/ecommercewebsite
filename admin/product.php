<?php 
require ("top.inc.php"); 

if(isset($_GET['type']) && $_GET['type']!=''){
    $type = get_safe_value($con,$_GET['type']);
    if($type=='status'){
        $operation = get_safe_value($con,$_GET['operation']); 
        $id = get_safe_value($con,$_GET['id']);
        if($operation=='active'){
            $status='1';
        }else{
            $status='0';
        }
        $update_status_sql = "update product set status = '$status' where id='$id'";
        mysqli_query($con,$update_status_sql);
    }

    if($type=='delete'){ 
        $id = get_safe_value($con,$_GET['id']);
        $delete_sql = "delete from product where id='$id'";
        mysqli_query($con,$delete_sql);
    }
}

$sql = "select product.*,categories.categories from product,categories where product.categories_id=categories.id order by product.id desc";
$res=mysqli_query($con,$sql);
?>

<div class="col-sm-9 mx-auto my-4">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4>Products</h4>
                <h4 class="box-link"><a href="manage_product.php">Add Product</a></h4>
            </div>
            <table class="table table-flush">
                <thead>
                    <tr class="bg-secondary">
                        <th>#</th>
                        <th>ID</th>
                        <th>Categories</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>MRP</th>
                        <th>Qty</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    while($row=mysqli_fetch_assoc($res)){ ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['categories'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" height="50"></td>
                        <td><?php echo $row['mrp'] ?></td>
                        <td><?php echo $row['quantity'] ?></td>
                        <td class="text-right">
                        <?php 
                        if($row['status']==1){
                            echo "<a class='btn btn-success' href='?type=status&operation=deactive&id=".$row['id']."'>Active</a>&nbsp;";
                        }else{
                            echo "<a class='btn btn-warning' href='?type=status&operation=active&id=".$row['id']."'>Deactive</a>&nbsp;";
                        }
                        echo "<a class='btn btn-info' href='manage_product.php?id=".$row['id']."'>Edit</a>&nbsp;";
                        echo "<a class='btn btn-danger' href='?type=delete&id=".$row['id']."'>Delete</a>";
                        ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php require ("footer.inc.php"); ?>
</body>
</html>