<?php
require 'navbar.php';
$order_id=get_safe_value($con,$_GET['id']);

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
                    <td>Product Name</td>
                    <td>Product Image</td>
                    <td>Qty</td>
                    <td>Price</td>
                    <td>Total Price</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $uid=$_SESSION['USER_ID'];
                $res=mysqli_query($con,"select distinct(order_detail.id),order_detail.*,product.name,product.image from order_detail,product,`order` where order_detail.order_id='$order_id' and `order`.user_id='$uid' and order_detail.product_id=product.id");
                $total_price=0;
                while($row=mysqli_fetch_assoc($res)){
                    $total_price=$total_price+($row['qty']*$row['price']);
                ?>
                <tr>
                    <td class="align-middle"><?php echo $row['name'] ?></td>
                    <td class="align-middle"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>"></td>
                    <td class="align-middle"><?php echo $row['qty'] ?></td>
                    <td class="align-middle"><?php echo $row['price'] ?></td>
                    <td class="align-middle"><?php echo $row['qty']*$row['price'] ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3"></td>
                    <td class="align-middle">Total Price</td>
                    <td class="align-middle"><?php echo $total_price ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>