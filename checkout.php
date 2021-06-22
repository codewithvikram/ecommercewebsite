<?php
require 'navbar.php';
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0 ){
    header('location:index.php');
    die();
}

$cart_total=0;
foreach($_SESSION['cart'] as $key => $val){
    $productArr=get_product($con,'','',$key);
    $price=$productArr[0]['mrp'];
    $qty=$val['qty'];
    $cart_total=$cart_total+($price*$qty);
}

if(isset($_POST['submit'])){
    $address=get_safe_value($con,$_POST['address']);
    $city=get_safe_value($con,$_POST['city']);
    $pincode=get_safe_value($con,$_POST['pincode']);
    $payment_type=get_safe_value($con,$_POST['payment_type']);
    $user_id=$_SESSION['USER_ID'];
    $total_price=$cart_total;
    $payment_status="pending";
    if($payment_type=='cod'){
        $payment_status="success";
    }
    $order_status="1";
    $added_on=date('Y-m-d h:i:s');

    mysqli_query($con,"insert into `order`(user_id,address,city,pincode,payment_type,total_price,payment_status,order_status,added_on) values('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on')");

    $order_id=mysqli_insert_id($con);

    foreach($_SESSION['cart'] as $key => $val){
        $productArr=get_product($con,'','',$key);
        $price=$productArr[0]['mrp'];
        $qty=$val['qty'];

        mysqli_query($con,"insert into `order_detail`(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");
    }
    unset($_SESSION['cart']);
    header('location:thank_you.php');
    die();
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
                    <a class="mx-2" href="checkout.php">Checkout</a>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-8 my-5">
            <?php 
            $accordion_id="plus";
            $accordion_class="";
            if(!isset($_SESSION['USER_LOGIN'])){
                $accordion_id="plus0";
                $accordion_class="d-none";
            ?>
            <button class="btn btn-dark btn-block text-left" id='plus'><span class="fa fa-minus mx-2"></span>CHECKOUT METHOD</button>         
            <div class="row" id="collapseOne">
                <div class="col-sm-6">
                    <p class="text-success" id="login_msg"></p>
                    <p class="head-style">LOGIN</p>
                    <form method="post">
                        <div class="form-group">
                        <label class="p-style"><i class="fa fa-user fa-fw"></i>Email *</label>
                        <input
                            type="email"
                            name="login_email"
                            id="login_email"
                            class="form-control"
                        />
                        </div>
                        <p class="field_error" id="email_error"></p>
                        <div class="form-group">
                        <label class="p-style"><i class="fa fa-lock fa-fw"></i>Password *</label>
                        <input
                            type="password"
                            name="login_password"
                            id="login_password"
                            class="form-control"
                        />
                        </div>
                        <p class="field_error" id="pass_error"></p>
                        <div class="form-group">
                        <button
                            type="button"
                            id="login"
                            class="btn btn-primary mb-4 mt-2"
                            onclick = "user_login()"
                        >
                            Login
                        </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <p class="text-success" id="register_msg"></p>
                    <p class="head-style">REGISTRATION</p>
                    <form method="post">
                        <div class="form-group">
                        <label class="p-style"><i class="fa fa-user fa-fw"></i>Name *</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                        />
                        </div>
                        <p class="field_error" id="name_err"></p>
                        <div class="form-group">
                        <label class="p-style"><i class="fa fa-user fa-fw"></i>Email *</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                        />
                        </div>
                        <p class="field_error" id="email_err"></p>
                        <div class="form-group">
                        <label class="p-style"><i class="fa fa-lock fa-fw"></i>Password *</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                        />
                        </div>
                        <p class="field_error" id="pass_err"></p>
                        <div class="form-group">
                        <label class="p-style"><i class="fa fa-mobile fa-fw fa-lg"></i>Mobile Number *</label>
                        <input
                            type="text"
                            name="mobile"
                            id="mobile"
                            class="form-control"
                        />
                        </div>
                        <p class="field_error" id="mobile_err"></p>
                        <div class="form-group">
                        <button
                            type="button"
                            id="register"
                            class="btn btn-primary mb-4 mt-2"
                            onclick = "user_register()"
                        >
                            Register
                        </button>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
            <button class="btn btn-dark btn-block text-left mt-2" id="<?php echo $accordion_id ?>1"><span class="fa fa-minus mx-2"></span>ADDRESS INFORMATION</button>
            <form method="post">
                <div id="collapseTwo" class="mt-5 <?php echo $accordion_class ?>">
                    <div class="form-group">
                        <input
                            type="text"
                            name="address"
                            id="address"
                            placeholder="Street Address"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="row" id="collapseOne">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input
                                    type="text"
                                    name="city"
                                    id="city"
                                    placeholder="City/State"
                                    class="form-control"
                                />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input
                                    type="text"
                                    name="pincode"
                                    id="pincode"
                                    placeholder="Post code/zip"
                                    class="form-control"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-dark btn-block text-left mt-2 mb-5" id="<?php echo $accordion_id ?>2"><span class="fa fa-minus mx-2"></span>PAYMENT INFORMATION</button>
                <div id="collapseThree" class="<?php echo $accordion_class ?>">
                    COD <input type="radio" name="payment_type" value="COD" required>&nbsp;&nbsp;
                    PayU <input type="radio" name="payment_type" value="payu" required>
                    <div class="my-4">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4 my-5 px-5">
            <p class="head-style text-center pb-3">YOUR ORDER</p><hr>
            <?php
            $cart_total=0;
            foreach($_SESSION['cart'] as $key => $val){
                $productArr=get_product($con,'','',$key);
                $pname=$productArr[0]['name'];
                $price=$productArr[0]['mrp'];
                $image=$productArr[0]['image'];
                $qty=$val['qty'];
                $cart_total=$cart_total+($price*$qty);
            ?>
            <div class="py-2">
                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" width="80">
                <div class="d-inline-block align-middle mx-4">
                    <p class="mb-0"><?php echo $pname ?></p>
                    <span><b><?php echo $price * $qty ?></b></span>
                </div>
                <div class="float-right mt-3">
                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="fa fa-trash-o fa-lg"></i></a>
                </div>
            </div>
            <?php } ?>
            <hr>
            <div class="mb-2">
                <p class="d-inline head-style">ORDER TOTAL</p>
                <span class="float-right"><b><?php echo $cart_total ?></b></span>   
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php require 'footer.php' ?>