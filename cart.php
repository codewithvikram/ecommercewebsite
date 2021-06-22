<?php 
require ('navbar.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
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
                    <span class="mx-2">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container my-5 pt-5">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <td>PRODUCTS</td>
                <td>NAME OF PRODUCTS</td>
                <td>MRP</td>
                <td>QUANTITY</td>
                <td>TOTAL</td>
                <td>REMOVE</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($_SESSION['cart'] as $key => $val){
                    $productArr=get_product($con,'','',$key);
                    $pname=$productArr[0]['name'];
                    $mrp=$productArr[0]['mrp'];
                    $image=$productArr[0]['image'];
                    $qty=$val['qty'];
            ?>
            <tr>
                <td>
                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" alt="product images" width="200">
                </td>
                <td class="align-middle">
                    <h4><a href=""><?php echo $pname ?></a></h4>
                </td>
                <td class="align-middle"><?php echo $mrp ?></td>
                <td class="align-middle"><input type="number" id="<?php echo $key ?>qty" value="<?php echo $qty ?>">
                <br><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','','update')">update</a>
                </td>
                <td class="align-middle"><?php echo $qty*$mrp ?></td>
                <td class="align-middle"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','','remove')"><i class="fa fa-trash-o fa-lg"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="shop my-5">
        <button class="btn btn-dark"><a href="<?php echo SITE_PATH ?>">CONTINUE SHOPPING</a></button>
        <button class="btn btn-dark float-right"><a href="<?php echo SITE_PATH ?>checkout.php">CHECKOUT</a></button>
    </div>
</div>
</body>
</html>

<?php require ('footer.php') ?>