<?php
require ('connection.inc.php');
require ('functions.inc.php');
require ('add_to_cart.inc.php');

$cat_res=mysqli_query($con, "select * from categories where status=1 order by categories asc");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
  $cat_arr[]=$row;
}

$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();

if(isset($_SESSION['USER_LOGIN'])){
  $uid=$_SESSION['USER_ID'];
  if(isset($_GET['wishlist_id'])){
    $wid=get_safe_value($con,$_GET['wishlist_id']);
    mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid'");
  }

  $wishlist_count=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'"));
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
  <title>Ecom Website</title>
</head>
<body>
<div class="row header" id="navbar">
  <div class="col-sm-3">
    <div id="logo">
      <a href="index.php"><img src="images/add_cart.png" alt="logo" height="50px"/></a>
    </div>
  </div>
  <div class="col-sm-9">
    <ul class="nav">
      <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
      </li>    
      <?php
      foreach($cat_arr as $list){
        ?>
          <li class="nav-item active">
            <a class="nav-link" href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a>
          </li>
        <?php
      }
      ?>
      <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
      </li>
      <div class="form-inline form_right">
        <li class="nav-item">
          <a id="search_btn" class="p-2">
            <i class="fa fa-search"></i>
          </a>
        </li>
        <li class="mr-1">|</li>
        <li class="nav-item">
        <?php 
        if(isset($_SESSION['USER_LOGIN'])){
          echo '<a class="nav-link" href="logout.php">Logout</a>';
        }else{
          echo '<a class="nav-link" href="login.php">Login/Register</a>';
        }
        ?>
        </li>
        <li class="mr-1">|</li>
        <?php 
        if(isset($_SESSION['USER_LOGIN'])){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="my_order.php">My Order</a>
        </li>
        <li class="mr-1">|</li>
        <li class="nav-item">
            <a class="nav-link tag" href="wishlist.php"><i class="fa fa-heart-o"><span class="wishes"><?php echo $wishlist_count ?></span></i></a>
        </li>
        <li class="mr-1">|</li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link tag" href="cart.php"><i class="fa fa-shopping-bag"><span class="notify"><?php echo $totalProduct ?></span></i></a>
        </li>
      </div>
    </ul>
  </div>
</div>
<div id="search_bar">
  <div class="search_action">
    <div class="modal-content search_bg px-5 py-2">
      <div class="modal-body px-5">
        <form action="search.php">
          <div class="search_input">
            <input type="text" class="form-control" name="str" placeholder="Search here...">
            <span class="fa fa-search bar"></span>
          </div>
          <button class="close">
            <span class="dismiss">&times;</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  window.onscroll = function () {
    myFunction();
  };

  var header = document.getElementById("navbar");
  var sticky = header.offsetTop;

  function myFunction() {
      if (window.pageYOffset > sticky) {  
          header.classList.add("sticky");
      } else {
          header.classList.remove("sticky");
      }
  }
</script>

</body>
</html>