<?php 
require ('navbar.php'); 
if(!isset($_SESSION['USER_LOGIN'])){
    header("location:login.php");
    die();
}
$uid=$_SESSION['USER_ID'];

$res=mysqli_query($con,"select product.name,product.image,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'");

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
                    <span class="mx-2">Wishlist</a>
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
                <td>REMOVE</td>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row=mysqli_fetch_assoc($res)){
            ?>
            <tr>
                <td>
                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt="product images" width="200">
                </td>
                <td class="align-middle">
                    <h4><a href=""><?php echo $row['name'] ?></a></h4>
                    <ul class="price">
                        <li class="old_price"><?php echo $row['mrp'] ?></li>
                    </ul>
                </td>
                <td class="align-middle"><a href="wishlist.php?wishlist_id=<?php echo $row['id'] ?>" ><i class="fa fa-trash-o fa-lg"></i></a></td>
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