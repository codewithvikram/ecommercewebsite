<?php
require ("connection.inc.php");
require ("functions.inc.php");
$msg = "";
if(isset($_POST['submit'])){
    $username = get_safe_value($con,$_POST['username']);   
    $password = get_safe_value($con,$_POST['password']);
    $sql = "select * from admin_users where username = '$username' and password = '$password'";
    $res = mysqli_query($con,$sql);
    $count = mysqli_num_rows($res);
    if($count>0){
      $_SESSION['ADMIN_LOGIN']='yes';
      $_SESSION['ADMIN_USERNAME']=$username;
      header("location: categories.php");
      die();
    }else{
      $msg = "Please enter valid login details";
    }   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <title>Ecommerce</title>
</head>
<body>
<div class="container mb-5 pb-5">
  <div class="row justify-content-center">
    <div class="col-sm-6 mb-5">
      <h1 class="primary center head-margin">User Login</h1>
      <form action="" method="post">
        <div class="form-group">
          <label class="p-style"><i class="fa fa-user fa-fw"></i>Username *</label>
          <input
            type="text"
            name="username"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label class="p-style"><i class="fa fa-lock fa-fw"></i>Password *</label>
          <input
            type="password"
            name="password"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <button
            type="submit"
            name="submit"
            class="btn btn-primary mt-2"
          >
            Login
          </button>
        </div>
      </form>
      <div class="field_error"><?php echo $msg ?></div>
    </div>
  </div>
</div>
</body>
</html>