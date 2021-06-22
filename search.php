<?php require ('navbar.php'); 
$str=mysqli_real_escape_string($con,$_GET['str']);
if($str!=''){
    $get_product=get_product($con,'','','',$str);
}else{
    header("location: index.php");
    die();
}

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
                        <a class="mx-2" href="search.php">Search</a>
                        <span class="fa fa-chevron-right"></span>
                        <span class="mx-2"><?php echo $str ?></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <?php  
            if(count($get_product)>0){  
            foreach($get_product as $list){?>
            <div class="col-sm-3">
                <div class="category">
                    <div class="list_hover">
                        <a href="product.php?id=<?php echo $list['id'] ?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>" alt="product images" width="270"></a>
                        <ul class="product_action">
                            <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id'] ?>','add')"><i class="fa fa-heart-o"></i></a></li>
                            <li><a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id'] ?>',1,'add')"><i class="fa fa-shopping-bag"></i></a></li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <h4><?php echo $list['name'] ?></h4>
                        <ul class="price">
                            <li class="old_price"><?php echo $list['mrp'] ?></li>
                            <li class="new_price"><?php echo $list['price'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } 
            }else{
                echo "Product not found";
            }
            ?>
        </div>
    </div>   
</body>
</html>
<?php require ('footer.php') ?>