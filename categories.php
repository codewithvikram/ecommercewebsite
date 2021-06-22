<?php require ('navbar.php'); 
$cat_id=mysqli_real_escape_string($con,$_GET['id']);
$sort_order='';
$price_low_selected="";
$price_high_selected="";
$new_selected="";
$old_selected="";
if(isset($_GET['sort'])){
    $sort=mysqli_real_escape_string($con,$_GET['sort']);
    if($sort=="price_high"){
        $sort_order=" order by product.price desc ";
        $price_high_selected="selected";
    }
    if($sort=="price_low"){
        $sort_order=" order by product.price asc ";
        $price_low_selected="selected";
    }
    if($sort=="new"){
        $sort_order=" order by product.id desc ";
        $new_selected="selected";
    }
    if($sort=="old"){
        $sort_order=" order by product.id asc ";
        $old_selected="selected";
    }
}

if($cat_id>0){
    $get_product=get_product($con,'',$cat_id,'','',$sort_order);
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
                        <a class="mx-2" href="product.php">Products</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="mb-5">
            <select name="select_prod" onchange="sort_product_drop('<?php echo $cat_id ?>','<?php echo SITE_PATH ?>')" id="sort_product_id">
                <option value="">Default Softing</option>
                <option value="price_low" <?php echo $price_low_selected ?>>Sort by price low to high</option>
                <option value="price_high" <?php echo $price_high_selected ?>>Sort by price high to low</option>
                <option value="new" <?php echo $new_selected ?>>Sort by new first</option>
                <option value="old" <?php echo $old_selected ?>>Sort by old first</option>
            </select>
        </div>
        <div class="row">
            <?php  
            if(count($get_product)>0){  
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