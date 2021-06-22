<?php
require "navbar.php";

$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $name = $_POST["name"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];
  $comment = $_POST["comment"];
  $added_on=date('Y-m-d h:i:s');

  if(empty(trim($name))){
    $showError = "Name should not be blank";
  }
  else{
    $existSql = "Select * from contact_us where name = '$name'";
    $result = mysqli_query($con, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0)
    {
      $showError = "Name Already Exists";
    }
    else if(empty(trim($email))){
      $showError = "Email should not be blank"; 
    }
    else if(empty(trim($mobile))){
      $showError = "Phone Number should not be blank";
    }
    else if(empty(trim($comment))){
      $showError = "message should not be blank";
    }
    else{
      $sql = "INSERT INTO `contact_us` (`name`, `email`, `mobile`, `comment`, `added_on`) VALUES ('$name', '$email', '$mobile', '$comment', '$added_on')";
      $result = mysqli_query($con, $sql);
      if($result){
        $showAlert = true;
      }
    }
  }
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
    <title>Ecommerce</title>
</head>
<body class="bg-grey">
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
                  <a class="mx-2" href="contact.php">Contact Us</a>
              </nav>
          </div>
      </div>
  </div>
</div>
<?php 
if($showAlert){
  echo '<div id="dismiss" class="alert alert-success alert-dismissible fade show mb-0" role="alert">
   <strong>Success! </strong> Your data is saved.
   <button type="button" onclick="dismiss();" class="close" data-bs-dismiss="alert" aria-label="Close"><span>&times;</span></button>
 </div>';
 }
 if($showError){
  echo '<div id="dismiss" class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
   <strong>Error! </strong>'. $showError.'
   <button type="button" onclick="dismiss();" class="close" data-bs-dismiss="alert" aria-label="Close"><span>&times;</span></button>
 </div>';
 }
?>
<div class="bg-art">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6 my-4">
        <h1 class="text-center head-style">Contact Us</h1>
        <form action="<?php echo SITE_PATH.'contact.php' ?>" method="post">
          <div class="form-group">
            <input
              type="text"
              name="name"
              class="form-control"
              placeholder="Name*"
            />
          </div>
          <div class="form-group">
            <input
              type="email"
              name="email"
              class="form-control"
              placeholder="E-Mail*"
            />
          </div>
          <div class="form-group">
            <input
              type="text"
              name="mobile"
              class="form-control"
              placeholder="Phone*"
            />
          </div>
          <div class="form-group">
            <textarea
              name="comment"
              rows="5"
              class="form-control"
              placeholder="Message*"
            ></textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require 'footer.php' ?>

<script>
   function dismiss(){
        var x=document.getElementById("dismiss");
        x.style.display='none';
    }
</script>
</body>
</html>