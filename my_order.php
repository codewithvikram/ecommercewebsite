<?php
require 'navbar.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Document</title>
</head>
<body>
<div class="overlay">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img class="my-3" src="<?php echo SITE_PATH.'images/package-delivery.png' ?>" alt="product" height="180">
            </div>
            <div class="col-sm-6">
                <nav class="bread-crump">
                    <a class="mx-2" href="index.php">Home</a>
                    <span class="fa fa-chevron-right"></span>
                    <a class="mx-2" href="my_order.php">My Order</a>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="my-5">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <td>Order Id</td>
                    <td>Order Date</td>
                    <td>Address</td>
                    <td>Payment Type</td>
                    <td>Payment Status</td>
                    <td>Order Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $uid=$_SESSION['USER_ID'];
                $res=mysqli_query($con,"select `order`.*,order_status.name as order_status_str from `order`,order_status where `order`.user_id='$uid' and order_status.id=`order`.order_status");
                while($row=mysqli_fetch_assoc($res)){
                ?>
                <tr>
                    <td class="align-middle"><a href="my_order_details.php?id=<?php echo $row['id'] ?>" class="btn-style"><?php echo $row['id'] ?></a></td>
                    <td class="align-middle"><?php echo $row['added_on'] ?></td>
                    <td class="align-middle">
                    <?php echo $row['address'] ?><br>
                    <?php echo $row['city'] ?><br>
                    <?php echo $row['pincode'] ?>
                    </td>
                    <td class="align-middle"><?php echo $row['payment_type'] ?></td>
                    <td class="align-middle"><?php echo $row['payment_status'] ?></td>
                    <td class="align-middle"><?php echo $row['order_status_str'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>