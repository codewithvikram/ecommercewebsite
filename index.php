<?php require ('navbar.php') ?>
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
    <section id="home">
        <div class="slider-overlay">
            <h1 id="slider-heading"></h1>
            <p id="slider-para"></p>
        </div>    
    </section>
    <div class="container my-5">
        <h1 class="text-center head-style mb-5">New Arrivals</h1>
        <div class="row">
            <?php    
            $get_product=get_product($con,4);
            foreach($get_product as $list){?>
            <div class="col-sm-3 my-auto">
                <div class="category">
                    <div class="list_hover text-center">
                        <a href="product.php?id=<?php echo $list['id'] ?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>" alt="product images"></a>
                        <ul class="product_action">
                            <li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id'] ?>','add')"><i class="fa fa-heart-o"></i></a></li>
                            <li><a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id'] ?>',1,'add')"><i class="fa fa-shopping-bag"></i></a></li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <h4><?php echo $list['name'] ?></h4>
                        <ul class="price">
                            <li class="old_price"><?php echo $list['mrp'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
<?php require ('footer.php') ?>