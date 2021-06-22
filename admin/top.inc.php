<?php
require ("connection.inc.php");
require ("functions.inc.php");

if(!isset($_SESSION['ADMIN_LOGIN']) || $_SESSION['ADMIN_LOGIN']!='yes'){
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="../js/jquery.js"></script>
  <script src="../js/main.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/fontawesome.css">
  <title>Document</title>
</head>
<body>
<div class="row header" id="navbar">
  <div class="col-sm-3">
    <div id="logo">
      <img src="images/admin.png" alt="logo" />
    </div>
  </div>
  <div class="col-sm-9 my-auto">
    <div class="d-inline">
      <span class="fa fa-bars" id="hide"></span>
    </div>
    <div class="manage">
      <a onmouseover=show() onmouseout=hide();>Welcome Admin
      </a>
      <ul class="sub-item" id="orders">
        <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="row mr-0">
  <div class="col-sm-3" id="side_bar">
    <h4 class="mt-3 ml-5">MENU</h4>
    <ul class="menu">
      <li class="nav-item active">
        <a class="nav-link" href="categories.php">Categories Master</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product.php">Product Master</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="users.php">User Master</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact_us.php">Contact Us</a>
      </li>
    </ul>
  </div>

<script>

  function show(){
      document.getElementById("orders").style.display = 'block';
  }
  function hide(){
    setTimeout(() => {
      document.getElementById("orders").style.display = 'none';
    },2000);
  }

</script>