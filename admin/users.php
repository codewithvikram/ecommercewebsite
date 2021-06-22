<?php 
require ("top.inc.php"); 

if(isset($_GET['type']) && $_GET['type']!=''){
    $type = get_safe_value($con,$_GET['type']);
    if($type=='delete'){ 
        $id = get_safe_value($con,$_GET['id']);
        $delete_sql = "Delete from users where id='$id'";
        mysqli_query($con,$delete_sql);
    }
}

$sql = "select * from users order by id desc";
$res=mysqli_query($con,$sql);
?>

<div class="col-sm-9 mx-auto my-4">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4>Users</h4>
            </div>
            <table class="table table-flush">
                <thead>
                    <tr class="bg-secondary">
                        <th>#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Date</th>
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
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['mobile'] ?></td>
                        <td><?php echo $row['added_on'] ?></td>
                        <td class="text-right">
                        <?php
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