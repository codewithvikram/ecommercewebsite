<?php require ('navbar.php'); 
$product_id=mysqli_real_escape_string($con,$_GET['id']);
if($product_id>0){
    $get_product=get_product($con,'','',$product_id);
}else{
?>
<script>
    window.location.href="index.php";
</script>
<?php
}
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
                        <a class="mx-2" href="categories.php?id=<?php echo $get_product['0']['categories_id'] ?>"><?php echo $get_product['0']['categories'] ?></a>
                        <span class="fa fa-chevron-right"></span>
                        <span class="mx-2"><?php echo $get_product['0']['name'] ?></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-4">
                <div class="category">
                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image'] ?>" alt="product images">
                </div>
            </div>
            <div class="col-sm-8">
                <div>
                    <h4><?php echo $get_product['0']['name'] ?></h4>
                    <ul class="price">
                        <li class="old_price"><?php echo $get_product['0']['mrp'] ?></li>
                        <li class="new_price"><?php echo $get_product['0']['price'] ?></li>
                    </ul>
                    <p><?php echo $get_product['0']['short_desc'] ?></p>
                    <p><strong>Availablity : </strong> In Stock</p>
                    <p><strong>Quantity : </strong></p>
                    <select class="mb-4" id="qty">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <p><strong>Categories : </strong><?php echo $get_product['0']['categories'] ?></p>
                    <button class="btn btn-primary"><a href="javascript:void(0);" onclick="manage_cart('<?php echo $get_product['0']['id'] ?>','','add')">Add to cart</a></button>
                </div>
            </div>
        </div>
        <div class="head-style">
            <h1>Description</h1>
            <p><?php echo $get_product['0']['description'] ?></p>
        </div>
    </div>
</body>
</html>
<?php require ('footer.php') ?>