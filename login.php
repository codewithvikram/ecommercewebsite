<?php
require 'navbar.php';
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
  header("location:my_order.php");
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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <title>Ecommerce</title>
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
                    <a class="mx-2" href="login.php">Login/Register</a>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-6 my-4">
      <p class="text-success" id="login_msg"></p>
      <h1 class="head-style">LOGIN</h1>
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
    <div class="col-sm-6 my-4">
      <p class="text-success" id="register_msg"></p>
      <h1 class="head-style">REGISTRATION</h1>
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
</div>
<?php include 'footer.php' ?>
<script>
   function dismiss(){
        var x=document.getElementById("dismiss");
        x.style.display='none';
    }

</script>
</body>
</html>